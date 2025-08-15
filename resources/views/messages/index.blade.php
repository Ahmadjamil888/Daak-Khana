<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-title text-xl font-semibold text-neutral-800 leading-tight">
                Messages - Booking #{{ $booking->booking_number }}
            </h2>
            <a href="{{ route('bookings.show', $booking) }}" 
               class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                Back to Booking
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Booking Info Header -->
                <div class="bg-gray-50 p-4 border-b">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="font-semibold">{{ $booking->customer->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $booking->courierCompany->company_name }}</p>
                        </div>
                        <div class="text-right">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                @if($booking->status === 'delivered') bg-green-100 text-green-800
                                @elseif($booking->status === 'in_transit') bg-blue-100 text-blue-800
                                @elseif($booking->status === 'picked_up') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Messages Container -->
                <div id="messages-container" class="h-96 overflow-y-auto p-4 space-y-4">
                    @forelse($messages as $message)
                        <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-xs lg:max-w-md px-4 py-2 rounded-lg
                                {{ $message->sender_id === auth()->id() 
                                    ? 'bg-primary-600 text-white' 
                                    : 'bg-gray-200 text-gray-900' }}">
                                <div class="text-sm">
                                    {{ $message->message }}
                                </div>
                                <div class="text-xs mt-1 opacity-75">
                                    {{ $message->created_at->format('M j, g:i A') }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-gray-500 py-8">
                            No messages yet. Start the conversation!
                        </div>
                    @endforelse
                </div>

                <!-- Message Input -->
                <div class="border-t p-4">
                    <form id="message-form" class="flex space-x-2">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                        <input type="text" 
                               name="message" 
                               id="message-input"
                               placeholder="Type your message..."
                               class="flex-1 rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500"
                               required>
                        <button type="submit" 
                                class="bg-primary-600 text-white px-6 py-2 rounded-lg hover:bg-primary-700 transition-colors">
                            Send
                        </button>
                    </form>
                </div>
            </div>

            @if(auth()->user()->isProActive())
                <div class="mt-4 p-4 bg-green-50 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-green-800 font-semibold">Pro Feature Active</span>
                    </div>
                    <p class="text-green-700 text-sm mt-1">
                        Real-time messaging enabled. Messages will appear instantly.
                    </p>
                </div>
            @endif
        </div>
    </div>

    <script>
        const messageForm = document.getElementById('message-form');
        const messageInput = document.getElementById('message-input');
        const messagesContainer = document.getElementById('messages-container');

        // Auto-scroll to bottom
        function scrollToBottom() {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        // Initial scroll
        scrollToBottom();

        // Handle form submission
        messageForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(messageForm);
            const message = messageInput.value.trim();
            
            if (!message) return;

            try {
                const response = await fetch('{{ route("messages.store", $booking) }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        message: message,
                        type: 'text'
                    })
                });

                if (response.ok) {
                    const data = await response.json();
                    
                    // Add message to UI
                    const messageDiv = document.createElement('div');
                    messageDiv.className = 'flex justify-end';
                    messageDiv.innerHTML = `
                        <div class="max-w-xs lg:max-w-md px-4 py-2 rounded-lg bg-primary-600 text-white">
                            <div class="text-sm">${message}</div>
                            <div class="text-xs mt-1 opacity-75">Just now</div>
                        </div>
                    `;
                    
                    messagesContainer.appendChild(messageDiv);
                    messageInput.value = '';
                    scrollToBottom();
                } else {
                    alert('Failed to send message. Please try again.');
                }
            } catch (error) {
                console.error('Error sending message:', error);
                alert('Failed to send message. Please try again.');
            }
        });

        // Poll for new messages (simple implementation)
        @if(auth()->user()->isProActive())
        setInterval(async function() {
            try {
                const response = await fetch('{{ route("messages.api", $booking) }}');
                if (response.ok) {
                    const data = await response.json();
                    // Update messages if needed (simplified)
                    // In a real app, you'd use WebSockets or Server-Sent Events
                }
            } catch (error) {
                console.error('Error fetching messages:', error);
            }
        }, 5000); // Poll every 5 seconds for pro users
        @endif
    </script>
</x-app-layout>