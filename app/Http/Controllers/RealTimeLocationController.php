<?php

namespace App\Http\Controllers;

use App\Models\RealTimeLocation;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealTimeLocationController extends Controller
{
    public function store(Request $request, Booking $booking)
    {
        $user = Auth::user();
        
        // Only couriers can update location
        if (!$user->isCourier() || $booking->courierCompany->user_id !== $user->id) {
            abort(403);
        }

        $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'address' => 'nullable|string|max:255',
            'status' => 'required|in:picked_up,in_transit,delivered',
            'metadata' => 'nullable|array'
        ]);

        $location = RealTimeLocation::create([
            'booking_id' => $booking->id,
            'courier_id' => $user->id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'address' => $request->address,
            'status' => $request->status,
            'metadata' => $request->metadata ?? [],
        ]);

        // Update booking status if needed
        if ($booking->status !== $request->status) {
            $booking->update(['status' => $request->status]);
            
            // Add tracking update
            $trackingUpdates = $booking->tracking_updates ?? [];
            $trackingUpdates[] = [
                'status' => $request->status,
                'message' => 'Location updated: ' . ($request->address ?? 'Coordinates provided'),
                'timestamp' => now()->toISOString(),
                'location' => [
                    'lat' => $request->latitude,
                    'lng' => $request->longitude,
                ]
            ];
            $booking->update(['tracking_updates' => $trackingUpdates]);
        }

        // Broadcast location update for real-time tracking
        // broadcast(new LocationUpdated($location));

        return response()->json([
            'success' => true,
            'location' => $location
        ]);
    }

    public function getLocation(Booking $booking)
    {
        $user = Auth::user();
        
        // Check if user has access and is pro (for customers)
        if ($user->isCustomer()) {
            if ($booking->customer_id !== $user->id) {
                abort(403);
            }
            
            if (!$user->isProActive()) {
                return response()->json(['error' => 'Pro subscription required for real-time tracking'], 403);
            }
        } elseif ($user->isCourier()) {
            if ($booking->courierCompany->user_id !== $user->id) {
                abort(403);
            }
        }

        $latestLocation = $booking->latestLocation;
        
        if (!$latestLocation) {
            return response()->json([
                'status' => 'pending',
                'message' => 'No location data available yet'
            ]);
        }

        return response()->json([
            'success' => true,
            'location' => $latestLocation,
            'status' => $latestLocation->status
        ]);
    }

    public function getLocationHistory(Booking $booking)
    {
        $user = Auth::user();
        
        // Check access and pro status
        if ($user->isCustomer()) {
            if ($booking->customer_id !== $user->id || !$user->isProActive()) {
                abort(403);
            }
        } elseif ($user->isCourier()) {
            if ($booking->courierCompany->user_id !== $user->id) {
                abort(403);
            }
        }

        $locations = $booking->realTimeLocations()
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'locations' => $locations
        ]);
    }

    public function updateLocationForm(Booking $booking)
    {
        $user = Auth::user();
        
        if (!$user->isCourier() || $booking->courierCompany->user_id !== $user->id) {
            abort(403);
        }

        return view('courier.update-location', compact('booking'));
    }
}
