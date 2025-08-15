<x-app-layout>
    <x-slot name="header">
        <h2 class="font-title text-xl font-semibold text-neutral-800 leading-tight">
            Chat with Daak Khana AI
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- AI Info Header -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 border-b">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Daak Khana AI Assistant</h3>
                            <p class="text-gray-600">Ask me anything about courier services, shipping, or our platform!</p>
                        </div>
                    </div>
                </div>

                <!-- Chat Container -->
                <div id="chat-container" class="h-96 overflow-y-auto p-6 space-y-4">
                    <div class="flex justify-start">
                        <div class="max-w-xs lg:max-w-md px-4 py-2 rounded-lg bg-gray-200 text-gray-900">
                            <div class="text-sm">
                                Hello! I'm Daak Khana AI. I can help you with:
                                <ul class="mt-2 text-xs list-disc list-inside">
                                    <li>Finding the right courier service</li>
                                    <li>Shipping rates and delivery times</li>
                                    <li>Tracking your packages</li>
                                    <li>Platform features and how to use them</li>
                                </ul>
                                What would you like to know?
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chat Input -->
                <div class="border-t p-4">
                    <form id="chat-form" class="flex space-x-2">
                        @csrf
                        <input type="text" 
                               name="message" 
                               id="chat-input"
                               placeholder="Ask me anything about courier services..."
                               class="flex-1 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                               required>
                        <button type="submit" 
                                id="send-button"
                                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                            Send
                        </button>
                    </form>
                </div>

                <!-- Free Feature Notice -->
                <div class="bg-green-50 p-4 border-t">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-green-800 font-semibold">Free Feature</span>
                    </div>
                    <p class="text-green-700 text-sm mt-1">
                        AI chat is available to all users at no cost. Get instant help with your courier needs!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const chatForm = document.getElementById('chat-form');
        const chatInput = document.getElementById('chat-input');
        const chatContainer = document.getElementById('chat-container');
        const sendButton = document.getElementById('send-button');

        // Auto-scroll to bottom
        function scrollToBottom() {
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        // Add message to chat
        function addMessage(message, isUser = false) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `flex ${isUser ? 'justify-end' : 'justify-start'}`;
            
            messageDiv.innerHTML = `
                <div class="max-w-xs lg:max-w-md px-4 py-2 rounded-lg ${
                    isUser 
                        ? 'bg-blue-600 text-white' 
                        : 'bg-gray-200 text-gray-900'
                }">
                    <div class="text-sm whitespace-pre-wrap">${message}</div>
                    <div class="text-xs mt-1 opacity-75">Just now</div>
                </div>
            `;
            
            chatContainer.appendChild(messageDiv);
            scrollToBottom();
        }

        // Handle form submission
        chatForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const message = chatInput.value.trim();
            if (!message) return;

            // Disable form
            sendButton.disabled = true;
            sendButton.textContent = 'Sending...';

            // Add user message
            addMessage(message, true);
            chatInput.value = '';

            try {
                const response = await fetch('{{ route("ai.chat") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ message: message })
                });

                if (response.ok) {
                    const data = await response.json();
                    
                    if (data.success) {
                        addMessage(data.response, false);
                    } else {
                        addMessage('Sorry, I encountered an error. Please try again.', false);
                    }
                } else {
                    addMessage('Sorry, I\'m having trouble connecting. Please try again later.', false);
                }
            } catch (error) {
                console.error('Error:', error);
                addMessage('Sorry, I\'m having trouble connecting. Please try again later.', false);
            } finally {
                // Re-enable form
                sendButton.disabled = false;
                sendButton.textContent = 'Send';
                chatInput.focus();
            }
        });

        // Focus input on load
        chatInput.focus();
    </script>
</x-app-layout>