<header class="absolute inset-x-0 top-0 z-50">
    <nav aria-label="Global" class="flex items-center justify-between p-6 lg:px-8">
        <div class="flex lg:flex-1">
            <a href="{{ route('dashboard') }}" class="-m-1.5 p-1.5">
                <span class="sr-only">Your Company</span>
                <img src="{{ asset('favicon.svg') }}" alt="Daak Khana Logo" class="h-8 w-auto" />
            </a>
        </div>
        <div class="flex lg:hidden">
            <button type="button" @click="open = ! open" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-200">
                <span class="sr-only">Open main menu</span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                    <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
        <div class="hidden lg:flex lg:gap-x-12">
            @auth
                @if(auth()->user()->isCustomer())
                    <a href="{{ route('dashboard') }}" class="text-sm/6 font-semibold text-white">Dashboard</a>
                    <a href="{{ route('companies.index') }}" class="text-sm/6 font-semibold text-white">Browse Companies</a>
                    <a href="{{ route('bookings.index') }}" class="text-sm/6 font-semibold text-white">My Bookings</a>
                    <a href="{{ route('ai.chat.show') }}" class="text-sm/6 font-semibold text-white">AI Assistant</a>
                    @if(!auth()->user()->isProActive())
                        <a href="{{ route('subscriptions.create') }}" class="text-sm/6 font-semibold text-indigo-400">Upgrade to Pro</a>
                    @endif
                @elseif(auth()->user()->isCourier())
                    <a href="{{ route('courier.dashboard') }}" class="text-sm/6 font-semibold text-white">Dashboard</a>
                    <a href="{{ route('courier.company.profile') }}" class="text-sm/6 font-semibold text-white">Company Profile</a>
                    <a href="{{ route('courier.bookings') }}" class="text-sm/6 font-semibold text-white">Bookings</a>
                    @if(auth()->user()->isProActive())
                        <a href="{{ route('ai.chat.show') }}" class="text-sm/6 font-semibold text-white">AI Tools</a>
                    @else
                        <a href="{{ route('subscriptions.create') }}" class="text-sm/6 font-semibold text-indigo-400">Pro Features</a>
                    @endif
                @endif
            @endauth
        </div>
        <div class="hidden lg:flex lg:flex-1 lg:justify-end">
            @auth
                <div class="relative">
                    <button @click="profileOpen = ! profileOpen" class="flex items-center text-sm font-semibold text-white focus:outline-none">
                        {{ Auth::user()->name }}
                        <svg class="ml-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div x-show="profileOpen" @click.away="profileOpen = false" class="absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-gray-800 ring-1 ring-black ring-opacity-5">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-700">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-700"
                               onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </a>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-sm/6 font-semibold text-white">Log in <span aria-hidden="true">&rarr;</span></a>
            @endauth
        </div>
    </nav>

    <!-- Mobile menu -->
    <div x-show="open" class="lg:hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 z-50"></div>
        <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-gray-900 px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-100/10">
            <div class="flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="-m-1.5 p-1.5">
                    <span class="sr-only">Your Company</span>
                    <img src="{{ asset('favicon.svg') }}" alt="Daak Khana Logo" class="h-8 w-auto" />
                </a>
                <button type="button" @click="open = false" class="-m-2.5 rounded-md p-2.5 text-gray-200">
                    <span class="sr-only">Close menu</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                        <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <div class="mt-6 flow-root">
                <div class="-my-6 divide-y divide-gray-500/10">
                    <div class="space-y-2 py-6">
                        @auth
                            @if(auth()->user()->isCustomer())
                                <a href="{{ route('dashboard') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-gray-800">Dashboard</a>
                                <a href="{{ route('companies.index') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-gray-800">Browse Companies</a>
                                <a href="{{ route('bookings.index') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-gray-800">My Bookings</a>
                                <a href="{{ route('ai.chat.show') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-gray-800">AI Assistant</a>
                                @if(!auth()->user()->isProActive())
                                    <a href="{{ route('subscriptions.create') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-indigo-400 hover:bg-gray-800">Upgrade to Pro</a>
                                @endif
                            @elseif(auth()->user()->isCourier())
                                <a href="{{ route('courier.dashboard') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-gray-800">Dashboard</a>
                                <a href="{{ route('courier.company.profile') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-gray-800">Company Profile</a>
                                <a href="{{ route('courier.bookings') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-gray-800">Bookings</a>
                                @if(auth()->user()->isProActive())
                                    <a href="{{ route('ai.chat.show') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-gray-800">AI Tools</a>
                                @else
                                    <a href="{{ route('subscriptions.create') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-indigo-400 hover:bg-gray-800">Pro Features</a>
                                @endif
                            @endif
                        @endauth
                    </div>
                    <div class="py-6">
                        @auth
                            <a href="{{ route('profile.edit') }}" class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-white hover:bg-gray-800">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-white hover:bg-gray-800"
                                   onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </a>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-white hover:bg-gray-800">Log in</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('navigation', () => ({
            open: false,
            profileOpen: false,
        }))
    })
</script>
