<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @php
                        $role = auth()->check() ? auth()->user()->roles->first()->nama_role : 'guest';
                    @endphp

                    @if ($role == 'Administrator')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')"  >
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    
                    @elseif ($role == 'Resepsionis')
                        <x-nav-link :href="route('resepsionis.dashboard')" :active="request()->routeIs('resepsionis.dashboard')"  >
                            {{ __('Dashboard') }}
                        </x-nav-link>

                    {{-- @elseif ($role == 'Pemilik')
                        <x-nav-link :href="route('pemilik.dashboard')" :active="request()->routeIs('pemilik.dashboard')"  >
                            {{ __('Dashboard') }}
                        </x-nav-link>

                    @elseif ($role == 'Dokter') 
                        <x-nav-link :href="route('dokter.dashboard')" :active="request()->routeIs('dokter.dashboard')"  >
                            {{ __('Dashboard') }}
                        </x-nav-link> --}}
                        
                    @else
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')"  >
                            {{ __('Home') }}
                        </x-nav-link>
                        
                        <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
                            {{ __('About') }}
                        </x-nav-link>
                    
                        <x-nav-link :href="route('layanan')" :active="request()->routeIs('layanan')">
                            {{ __('Layanan Umum') }}
                        </x-nav-link>

                        <x-nav-link :href="route('struktur')" :active="request()->routeIs('struktur')">
                            {{ __('Struktur') }}
                        </x-nav-link>    
                    @endif
                </div>
            </div>
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>

                    <x-nav-link href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        :active="request()->routeIs('logout')">
                        {{ __('Log Out') }}
                    </x-nav-link>
                @else
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        {{ __('Login') }}
                    </x-nav-link>
                @endauth
            </div>
            <!-- Settings Dropdown -->
                
            <!-- Hamburger -->
            {{-- <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div> --}}
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            {{-- <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth()->user()->nama }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->nama }}</div>
            </div> --}}

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
