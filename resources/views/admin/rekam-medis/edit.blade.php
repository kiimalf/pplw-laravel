<x-app-layout>
    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-6">
        <div class="p-6 text-lg font-semibold text-gray-900 dark:text-gray-100">
            Tambah Rekam Medis
        </div>
    </div>
    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-xl">
        <form action="{{ route('admin.rekam-medis.store') }}" method="POST" class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">

            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200">Reservasi</label>
                <select name="idreservasi_dokter" class="w-full mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200" >
                    <option value="{{ $rekamMedis->idreservasi_dokter }}" selected >{{ $rekamMedis->idreservasi_dokter }}</option>
                    @foreach ($reservasi as $item)
                        <option value="{{ $item->idreservasi_dokter }}">{{ $item->idreservasi_dokter }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200">Pet</label>
                <select name="idpet" class="w-full mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200" >
                    <option value="{{ $rekamMedis->idpet }}" selected >{{ $rekamMedis->pet->nama }}</option>
                    @foreach ($pet as $item)
                        <option value="{{ $item->idpet }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200">Anamnesa</label>
                <input type="text" name="anamnesa" value="{{ $rekamMedis->anamnesa }}"
                    class="w-full mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200">Temuan Klinis</label>
                <input type="text" name="temuan_klinis" value="{{ $rekamMedis->temuan_klinis }}"
                    class="w-full mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200">Diagnosa</label>
                <input type="text" name="diagnosa" value="{{ $rekamMedis->diagnosa }}"
                    class="w-full mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200">Dokter Pemeriksa</label>
                <select name="dokter_pemeriksa" class="w-full mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200" >
                    <option value="{{ $rekamMedis->dokter_pemeriksa }}" selected >{{ $rekamMedis->roleUser->user->nama }}</option>
                    @foreach ($dokter as $item)
                        <option value="{{ $item->idrole_user }}">{{ $item->user->nama }}</option>
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
                    <a href="{{ route('admin.rekam-medis.index') }}"
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