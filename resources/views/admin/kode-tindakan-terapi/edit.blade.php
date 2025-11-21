<x-app-layout>
    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-6">
        <div class="p-6 text-lg font-semibold text-gray-900 dark:text-gray-100">
            Edit Tindakan Terapi, Kode : {{ $kodeTindakanTerapi->kode }}
        </div>
    </div>
    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-xl">
        {{-- <form action="{{ route('admin.tindakan-terapi.update', $kodeTindakanTerapi->idkode_tindakan_terapi) }}" method="POST" class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6"> --}}

            @csrf
            {{-- Nama --}}
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200">Kode</label>
                <input type="text" name="kode" placeholder="{{ $kodeTindakanTerapi->kode }}" class="w-full mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200">Kategori</label>
                <select name="idkategori" class="w-full mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200">
                    <option value="{{ $kodeTindakanTerapi->idkategori }}" selected >{{ $kodeTindakanTerapi->kategori->nama_kategori }}</option>
                    @foreach ($kategori as $item)
                        <option value="{{ $item->idkategori }}">{{ $item->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200">Kategori Klinis</label>
                <select name="idkategori_klinis" class="w-full mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200">
                    <option value="{{ $kodeTindakanTerapi->idkategori_klinis }}"  selected>{{ $kodeTindakanTerapi->kategoriKlinis->nama_kategori_klinis }}</option>
                    @foreach ($kategoriKlinis as $item)
                        <option value="{{ $item->idkategori_klinis }}">{{ $item->nama_kategori_klinis }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200">Deskripsi</label>
                <input type="text" name="deskripsi_tindakan_terapi" placeholder="{{ $kodeTindakanTerapi->deskripsi_tindakan_terapi }}"
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
                    <a href="{{ route('admin.tindakan-terapi.index') }}"
                        class="px-4 py-2 bg-gray-600 text-white rounded-lg">Kembali</a>
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Update
                    </button>
                </div>
            </div>
            {{-- Tombol --}}
            
        </form>
    </div>
</x-app-layout>