<?php

namespace App\Http\Controllers;

use App\Services\GeminiService;
use App\Models\CourierCompany;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class AIController extends Controller
{
    protected $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    public function generateProfile(Request $request)
    {
        $user = Auth::user();
        
        if (!$user->isCourier() || !$user->isProActive()) {
            return response()->json(['error' => 'Pro courier subscription required'], 403);
        }

        $company = $user->courierCompany;
        if (!$company) {
            return response()->json(['error' => 'No courier company found'], 404);
        }

        try {
            $companyData = [
                'company_name' => $company->company_name,
                'service_areas' => $company->service_areas,
                'base_price' => $company->base_price,
                'operating_hours' => $company->operating_hours,
            ];

            $description = $this->geminiService->generateProfileDescription($companyData);
            
            // Update company with AI-generated description
            $company->update(['ai_generated_description' => $description]);

            return response()->json([
                'success' => true,
                'description' => $description
            ]);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function handleOrder(Request $request, Booking $booking)
    {
        $user = Auth::user();
        
        if (!$user->isCourier() || !$user->isProActive()) {
            return response()->json(['error' => 'Pro courier subscription required'], 403);
        }

        if ($booking->courierCompany->user_id !== $user->id) {
            abort(403);
        }

        $request->validate([
            'prompt' => 'required|string|max:500'
        ]);

        try {
            $orderDetails = [
                'booking_number' => $booking->booking_number,
                'customer_name' => $booking->customer->name,
                'pickup_address' => $booking->pickup_address,
                'delivery_address' => $booking->delivery_address,
                'status' => $booking->status,
            ];

            $response = $this->geminiService->handleOrderWithAI($orderDetails, $request->prompt);

            return response()->json([
                'success' => true,
                'response' => $response
            ]);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function chatWithDaakKhana(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500'
        ]);

        try {
            $user = Auth::user();
            $context = [];
            
            if ($user) {
                $context = [
                    'user_type' => $user->user_type,
                    'is_pro' => $user->isProActive(),
                ];
            }

            $response = $this->geminiService->chatWithDaakKhana($request->message, $context);

            return response()->json([
                'success' => true,
                'response' => $response
            ]);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function searchCouriers(Request $request)
    {
        $request->validate([
            'query' => 'required|string|max:200'
        ]);

        try {
            $couriers = CourierCompany::with('services')
                ->where('is_verified', true)
                ->get()
                ->map(function ($company) {
                    return [
                        'company_name' => $company->company_name,
                        'rating' => $company->rating,
                        'base_price' => $company->base_price,
                        'services' => $company->services->pluck('service_name')->toArray(),
                        'service_areas' => $company->service_areas,
                    ];
                })->toArray();

            $response = $this->geminiService->searchCouriers($request->query, $couriers);

            return response()->json([
                'success' => true,
                'response' => $response,
                'couriers' => $couriers
            ]);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function showChat()
    {
        return view('ai.chat');
    }

    public function showSearch()
    {
        return view('ai.search');
    }
}
