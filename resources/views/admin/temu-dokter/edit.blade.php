<x-app-layout>
    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-6">
        <div class="p-6 text-lg font-semibold text-gray-900 dark:text-gray-100">
            Edit emu Dokter, Pet : {{ $temuDokter->pet->nama }}
        </div>
    </div>
    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-xl">
        <form action="{{ route('admin.temu-dokter.update', $temuDokter->idreservasi_dokter) }}" method="POST" class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">

            @csrf
            {{-- Nama --}}
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200">No Urut</label>
                <input type="text" name="no_urut" placeholder="{{ $temuDokter->no_urut }}" disabled
                    class="w-full mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200">Pet</label>
                <input type="text" name="idpet" placeholder="{{ $temuDokter->pet->nama }}" disabled
                    class="w-full mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200">Dokter</label>
                <select name="idrole_user" class="w-full mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200">
                    <option value="{{ $temuDokter->idrole_user }}" selected disabled>{{ $temuDokter->roleUser->user->nama }}</option>
                    @foreach ($dokters as $dokter)
                        <option value="{{ $dokter->idrole_user }}">{{ $dokter->user->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-200">Status</label>
                <select name="status" class="w-full mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200">
                    
                        @if ($temuDokter->status == 0)
                            <option value="0" selected>Menunggu</option>
                            <option value="1">Selesai</option>
                        @else
                            <option value="1" selected>Selesai</option>
                            <option value="0">Menunggu</option>
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
                    <a href="{{ route('admin.temu-dokter.index') }}"
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