<x-app-layout>
    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-6">
        <div class="p-6 text-lg font-semibold text-gray-900 dark:text-gray-100">
            Edit Jenis Hewan {{ $jenisHewan->nama_jenis_hewan }}
        </div>
    </div>
    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-xl">
        <form action="{{ route('admin.jenis-hewan.update', $jenisHewan->idjenis_hewan) }}" method="POST" class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">

            @csrf
            {{-- Nama --}}
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200">Nama Jenis Hewan</label>
                <input type="text" name="nama_jenis_hewan" placeholder="{{ $jenisHewan->nama_jenis_hewan }}" class="w-full mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200">
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
                    <a href="{{ route('admin.jenis-hewan.index') }}"
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