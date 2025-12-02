<x-app-layout>
    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-6">
        <div class="p-6 text-lg font-semibold text-gray-900 dark:text-gray-100">
            Edit Pemilik {{ $user->nama }}
        </div>
    </div>
    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-xl">
        <form action="{{ route('admin.pemilik.update', $pemilik->idpemilik) }}" method="POST" class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">

            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200">Nama</label>
                <input type="text" name="nama" value="{{ $user->nama }}"
                    class="w-full mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200">Email</label>
                <input type="email" name="email" value="{{ $user->email }}"
                    class="w-full mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200">Nomor WA</label>
                <input type="text" name="no_wa" value="{{ $pemilik->no_wa }}"
                    class="w-full mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200">Alamat</label>
                <input type="text" name="alamat" value="{{ $pemilik->alamat }}"
                    class="w-full mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200">
            </div>

            <div class="flex justify-between">
                <div>
                    @if ($errors->any())
                        <div class="px-4 py-2 bg-red-200 text-red-800 rounded">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="gap-2 sm:flex sm:items-center sm:ms-6">
                    <a href="{{ route('admin.pemilik.index') }}"
                        class="px-4 py-2 bg-gray-600 text-white rounded-lg">Kembali</a>
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Simpan
                    </button>
                </div>
            </div>
            {{-- Tombol --}}
            
        </form>
    </div>
</x-app-layout>