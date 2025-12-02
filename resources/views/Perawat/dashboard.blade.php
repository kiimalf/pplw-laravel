<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Widget User -->
            {{-- <a href="{{ route('admin.user.index') }}" class="bg-white rounded-2xl shadow hover:shadow-lg transition transform hover:-translate-y-1 p-6 flex items-left gap-6">
                <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-700">Data User</h2>
                    <p class="text-sm text-gray-500 mt-1">Kelola akun pengguna sistem</p>
                </div>
                
            </a> --}}

            <!-- Widget Role -->
            {{-- <a href="{{ route('role.index') }}" 
            class="bg-white rounded-2xl shadow hover:shadow-lg transition transform hover:-translate-y-1 p-6 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-700">Data Role</h2>
                    <p class="text-sm text-gray-500 mt-1">Atur hak akses pengguna</p>
                </div>
                <div class="bg-purple-100 text-purple-600 p-3 rounded-full">
                    <x-lucide-shield class="w-6 h-6" />
                </div>
            </a>

            <!-- Widget Pemilik -->
            <a href="{{ route('pemilik.index') }}" 
            class="bg-white rounded-2xl shadow hover:shadow-lg transition transform hover:-translate-y-1 p-6 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-700">Data Pemilik</h2>
                    <p class="text-sm text-gray-500 mt-1">Informasi pemilik hewan</p>
                </div>
                <div class="bg-green-100 text-green-600 p-3 rounded-full">
                    <x-lucide-user-circle class="w-6 h-6" />
                </div>
            </a>

            <!-- Widget Hewan -->
            <a href="{{ route('hewan.index') }}" 
            class="bg-white rounded-2xl shadow hover:shadow-lg transition transform hover:-translate-y-1 p-6 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-700">Data Hewan</h2>
                    <p class="text-sm text-gray-500 mt-1">Daftar hewan peliharaan</p>
                </div>
                <div class="bg-amber-100 text-amber-600 p-3 rounded-full">
                    <x-lucide-paw-print class="w-6 h-6" />
                </div>
            </a>

            <!-- Widget Layanan -->
            <a href="{{ route('layanan.index') }}" 
            class="bg-white rounded-2xl shadow hover:shadow-lg transition transform hover:-translate-y-1 p-6 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-700">Data Layanan</h2>
                    <p class="text-sm text-gray-500 mt-1">Jenis layanan klinik</p>
                </div>
                <div class="bg-orange-100 text-orange-600 p-3 rounded-full">
                    <x-lucide-briefcase-medical class="w-6 h-6" />
                </div>
            </a>

            <!-- Widget Obat -->
            <a href="{{ route('obat.index') }}" 
            class="bg-white rounded-2xl shadow hover:shadow-lg transition transform hover:-translate-y-1 p-6 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-700">Data Obat</h2>
                    <p class="text-sm text-gray-500 mt-1">Persediaan obat klinik</p>
                </div>
                <div class="bg-rose-100 text-rose-600 p-3 rounded-full">
                    <x-lucide-pill class="w-6 h-6" />
                </div>
            </a> --}}
        </div>
        </div>
    </div>
</x-app-layout>