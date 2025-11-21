<x-app-layout>
    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-6">
        <div class="p-6 text-lg font-semibold text-gray-900 dark:text-gray-100">
            Tambah Ras Hewan
        </div>
    </div>
    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-xl">
        <form action="{{ route('admin.ras-hewan.store') }}" method="POST" class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">

            @csrf
            {{-- Nama --}}
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200">Nama Ras</label>
                <input type="text" name="nama_ras"
                    class="w-full mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200">Jenis Hewan</label>
                <select name="jenis_hewan" class="w-full mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200" >
                    <option value="" selected disabled>Pilih Jenis Hewan</option>
                    @foreach ($jenisHewan as $item)
                        <option value="{{ $item->idjenis_hewan }}">{{ $item->nama_jenis_hewan }}</option>
                    @endforeach
                </select>
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
                    <a href="{{ route('admin.ras-hewan.index') }}"
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