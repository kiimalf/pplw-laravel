<aside class="w-64 bg-white dark:bg-gray-800 shadow-lg fixed inset-y-0 left-0 z-50">
    <div class="p-6 font-bold text-lg text-gray-800 dark:text-gray-200">
        {{ config('app.name') }}
    </div>

    @php
        $role = auth()->check() ? auth()->user()->roleUser()->first()->role->nama_role : 'guest';
    @endphp

    <nav class="px-4 space-y-1">

        {{-- MENU ROLE ADMIN --}}
        @if ($role == 'Administrator')
            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                {{ __('Dashboard') }}
            </x-nav-link>
            
            {{-- DROPDOWN — DATA MASTER --}}
            <div x-data="{ open: false }">

                {{-- Tombol dropdown --}}
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-1 py-2
                        text-sm font-medium  {{-- ukuran sama dengan nav-link --}}
                        text-gray-700 dark:text-gray-200
                        ">
                    <span>Data Master</span>

                    <svg :class="{'rotate-180': open}" 
                        class="w-4 h-4 transition-transform"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                {{-- Isi dropdown --}}
                <div x-show="open" x-collapse class="ml-4 mt-1 space-y-1 flex flex-col">

                    <x-nav-link :href="route('admin.user.index')" :active="request()->routeIs('admin.user.index')">
                        Data User
                    </x-nav-link>

                    <x-nav-link :href="route('admin.role.index')" :active="request()->routeIs('admin.role.index')">
                        Data Role
                    </x-nav-link>

                    <x-nav-link :href="route('admin.role-user.index')" :active="request()->routeIs('admin.role-user.index')">
                        Data Role User
                    </x-nav-link>

                    <x-nav-link :href="route('admin.jenis-hewan.index')" :active="request()->routeIs('admin.jenis-hewan.index')">
                        Data Jenis Hewan
                    </x-nav-link>

                    <x-nav-link :href="route('admin.ras-hewan.index')" :active="request()->routeIs('admin.ras-hewan.index')">
                        Data Ras Hewan
                    </x-nav-link>

                    <x-nav-link :href="route('admin.pemilik.index')" :active="request()->routeIs('admin.pemilik.index')">
                        Data Pemilik
                    </x-nav-link>

                    <x-nav-link :href="route('admin.pet.index')" :active="request()->routeIs('admin.pet.index')">
                        Data Pet
                    </x-nav-link>

                    <x-nav-link :href="route('admin.rekam-medis.index')" :active="request()->routeIs('admin.rekam-medis.index')">
                        Data Rekam Medis
                    </x-nav-link>

                    <x-nav-link :href="route('admin.kategori.index')" :active="request()->routeIs('admin.kategori.index')">
                        Data Kategori
                    </x-nav-link>

                    <x-nav-link :href="route('admin.kategori-klinis.index')" :active="request()->routeIs('admin.kategori-klinis.index')">
                        Data Kategori Klinis
                    </x-nav-link>

                    <x-nav-link :href="route('admin.tindakan-terapi.index')" :active="request()->routeIs('admin.kode-tindakan.index')">
                        Data Kode Tindakan Terapi
                    </x-nav-link>

                    <x-nav-link :href="route('admin.temu-dokter.index')" :active="request()->routeIs('admin.temu-dokter.index')">
                        Data Temu Dokter
                    </x-nav-link>

                </div>

            </div>

        {{-- MENU ROLE RESEPSIONIS --}}
        @elseif ($role == 'Resepsionis')
            <x-nav-link :href="route('resepsionis.dashboard')" :active="request()->routeIs('resepsionis.dashboard')">
                {{ __('Dashboard') }}
            </x-nav-link>
            <div x-data="{ open: false }">

                {{-- Tombol dropdown --}}
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-1 py-2
                        text-sm font-medium  {{-- ukuran sama dengan nav-link --}}
                        text-gray-700 dark:text-gray-200
                        ">
                    <span>Data Master</span>

                    <svg :class="{'rotate-180': open}" 
                        class="w-4 h-4 transition-transform"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                {{-- Isi dropdown --}}
                <div x-show="open" x-collapse class="ml-4 mt-1 space-y-1 flex flex-col">
                    <x-nav-link :href="route('resepsionis.pemilik.index')" :active="request()->routeIs('resepsionis.pemilik.index')">
                        Data Pemilik
                    </x-nav-link>

                    <x-nav-link :href="route('resepsionis.pet.index')" :active="request()->routeIs('resepsionis.pet.index')">
                        Data Pet
                    </x-nav-link>

                    <x-nav-link :href="route('resepsionis.temu-dokter.index')" :active="request()->routeIs('resepsionis.temu-dokter.index')">
                        Data Temu Dokter
                    </x-nav-link>
                </div>

            </div>
        
        @elseif ($role == 'Dokter')
            <x-nav-link :href="route('dokter.dashboard')" :active="request()->routeIs('dokter.dashboard')">
                {{ __('Dashboard') }}
            </x-nav-link>
            <div x-data="{ open: false }">

                {{-- Tombol dropdown --}}
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-1 py-2
                        text-sm font-medium  {{-- ukuran sama dengan nav-link --}}
                        text-gray-700 dark:text-gray-200
                        ">
                    <span>Data Master</span>

                    <svg :class="{'rotate-180': open}" 
                        class="w-4 h-4 transition-transform"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                {{-- Isi dropdown --}}
                <div x-show="open" x-collapse class="ml-4 mt-1 space-y-1 flex flex-col">
                    <x-nav-link :href="route('dokter.pet.index')" :active="request()->routeIs('dokter.pet.index')">
                        Data Pasien
                    </x-nav-link>
                    <x-nav-link :href="route('dokter.temu-dokter.index')" :active="request()->routeIs('dokter.temu-dokter.index')">
                        Data Temu Dokter
                    </x-nav-link>
                    <x-nav-link :href="route('dokter.rekam-medis.index')" :active="request()->routeIs('dokter.rekam-medis.index')">
                        Data Rekam Medis
                    </x-nav-link>
                </div>
            </div>
        
        @elseif ($role == 'Perawat')
            <x-nav-link :href="route('perawat.dashboard')" :active="request()->routeIs('perawat.dashboard')">
                {{ __('Dashboard') }}
            </x-nav-link>
            <div x-data="{ open: false }">

                {{-- Tombol dropdown --}}
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-1 py-2
                        text-sm font-medium  {{-- ukuran sama dengan nav-link --}}
                        text-gray-700 dark:text-gray-200
                        ">
                    <span>Data Master</span>

                    <svg :class="{'rotate-180': open}" 
                        class="w-4 h-4 transition-transform"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                {{-- Isi dropdown --}}
                <div x-show="open" x-collapse class="ml-4 mt-1 space-y-1 flex flex-col">
                    <x-nav-link :href="route('perawat.pet.index')" :active="request()->routeIs('perawat.pet.index')">
                        Data Pet
                    </x-nav-link>
                </div>
                <div x-show="open" x-collapse class="ml-4 mt-1 space-y-1 flex flex-col">
                    <x-nav-link :href="route('perawat.rekam-medis.index')" :active="request()->routeIs('perawat.rekam-medis.index')">
                        Data Rekam Medis
                    </x-nav-link>
                </div>
            </div>

        @elseif ($role == 'Pemilik')
            <x-nav-link :href="route('pemilik.dashboard')" :active="request()->routeIs('pemilik.dashboard')">
                {{ __('Dashboard') }}
            </x-nav-link>
            <div x-data="{ open: false }">

                {{-- Tombol dropdown --}}
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-1 py-2
                        text-sm font-medium  {{-- ukuran sama dengan nav-link --}}
                        text-gray-700 dark:text-gray-200
                        ">
                    <span>Data Master</span>

                    <svg :class="{'rotate-180': open}" 
                        class="w-4 h-4 transition-transform"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                {{-- Isi dropdown --}}
                <div x-show="open" x-collapse class="ml-4 mt-1 space-y-1 flex flex-col">
                    <x-nav-link :href="route('pemilik.pet.index')" :active="request()->routeIs('pemilik.pet.index')">
                        Data Pet
                    </x-nav-link>
                </div>
                <div x-show="open" x-collapse class="ml-4 mt-1 space-y-1 flex flex-col">
                    <x-nav-link :href="route('pemilik.temu-dokter.index')" :active="request()->routeIs('pemilik.temu-dokter.index')">
                        Data Temu Dokter
                    </x-nav-link>
                </div>
                <div x-show="open" x-collapse class="ml-4 mt-1 space-y-1 flex flex-col">
                    <x-nav-link :href="route('pemilik.rekam-medis.index')" :active="request()->routeIs('pemilik.rekam-medis.index')">
                        Data Rekam Medis
                    </x-nav-link>
                </div>
            </div>
        {{-- MENU GUEST / USER BIASA --}}
        @else
            <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
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

        {{-- AUTH AREA --}}
        <div class="pt-4 border-t border-gray-300 dark:border-gray-700 mt-4">

            @auth
                {{-- LOGOUT BUTTON --}}
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-3 py-2 rounded-md text-red-600 hover:bg-red-100 dark:hover:bg-red-800">
                        Logout
                    </button>
                </form>

            @else
                <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                    {{ __('Login') }}
                </x-nav-link>
            @endauth

        </div>

    </nav>
</aside>
