
<x-app-layout>
    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-6">
        <div class="p-6 text-lg font-semibold text-gray-900 dark:text-gray-100">
            Edit Pet {{ $pet->nama }}
        </div>
    </div>
    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-xl">
        <form action="{{ route('resepsionis.pet.update', $pet->idpet) }}" method="POST" class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">

            @csrf
            <div class="mb-4">
                <<label class="block text-gray-700 dark:text-gray-200">Pemilik</label>
                <input type="text" value="{{ $pet->pemilik->user->nama }}" disabled name="pemilik" class="w-full mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200">
            </div>
            {{-- Nama --}}
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200">Nama Pet</label>
                <input type="text" name="nama_pet" placeholder="{{ $pet->nama }}"
                    class="w-full mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200">Tanggal Lahir</label>
                <input type="date" value="{{ $pet->tanggal_lahir }}" name="tanggal_lahir" class="w-full mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200">Warna Tanda</label>
                <input type="text" name="warna_tanda" placeholder="{{ $pet->warna_tanda }}"
                    class="w-full mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200">Ras Hewan</label>
                <select name="idras_hewan" class="w-full mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200" >
                    <option value="{{ $pet->idras_hewan }}" selected >{{ $pet->rasHewan->nama_ras }}</option>
                    @foreach ($rasHewan as $item)
                        <option value="{{ $item->idras_hewan }}">{{ $item->nama_ras }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="w-full mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200" >
                    @if ($pet->jenis_kelamin == 0)
                        <option value="0" selected>Jantan</option>
                        <option value="1">Betina</option>
                    @else
                        <option value="0" >Jantan</option>
                        <option value="1" selected>Betina</option>
                    @endif
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
                    <a href="{{ route('resepsionis.pet.index') }}"
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