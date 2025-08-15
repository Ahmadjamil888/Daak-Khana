<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(Booking $booking)
    {
        $user = Auth::user();
        
        // Check if user has access to this booking
        if ($user->isCustomer() && $booking->customer_id !== $user->id) {
            abort(403);
        }
        
        if ($user->isCourier() && $booking->courierCompany->user_id !== $user->id) {
            abort(403);
        }

        $messages = $booking->messages()
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'asc')
            ->get();

        // Mark messages as read
        $booking->messages()
            ->where('receiver_id', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);

        return view('messages.index', compact('booking', 'messages'));
    }

    public function store(Request $request, Booking $booking)
    {
        $user = Auth::user();
        
        // Check if user has access to this booking
        if ($user->isCustomer() && $booking->customer_id !== $user->id) {
            abort(403);
        }
        
        if ($user->isCourier() && $booking->courierCompany->user_id !== $user->id) {
            abort(403);
        }

        $request->validate([
            'message' => 'required|string|max:1000',
            'type' => 'in:text,image,file,location'
        ]);

        // Determine receiver
        $receiverId = $user->isCustomer() 
            ? $booking->courierCompany->user_id 
            : $booking->customer_id;

        $message = Message::create([
            'booking_id' => $booking->id,
            'sender_id' => $user->id,
            'receiver_id' => $receiverId,
            'message' => $request->message,
            'type' => $request->type ?? 'text',
            'metadata' => $request->metadata ?? null,
        ]);

        // Broadcast message for real-time updates (if using Pusher/WebSockets)
        // broadcast(new MessageSent($message));

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message->load(['sender', 'receiver'])
            ]);
        }

        return back()->with('success', 'Message sent successfully!');
    }

    public function getMessages(Booking $booking)
    {
        $user = Auth::user();
        
        // Check access
        if ($user->isCustomer() && $booking->customer_id !== $user->id) {
            abort(403);
        }
        
        if ($user->isCourier() && $booking->courierCompany->user_id !== $user->id) {
            abort(403);
        }

        $messages = $booking->messages()
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json(['messages' => $messages]);
    }

    public function markAsRead(Message $message)
    {
        $user = Auth::user();
        
        if ($message->receiver_id !== $user->id) {
            abort(403);
        }

        $message->markAsRead();

        return response()->json(['success' => true]);
    }
}
