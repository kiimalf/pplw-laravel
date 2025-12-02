<x-app-layout>
    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-6">
        <div class="p-6 text-lg font-semibold text-gray-900 dark:text-gray-100">
            Data Rekam Medis
        </div>
    </div>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-xl">
        <table class="table-fixed min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-gray-900 dark:text-gray-100">

            <thead class="bg-gray-300 dark:bg-gray-700 ">
                <tr class="text-center">
                    <th class="px-6 py-4 text-xs font-bold uppercase w-10 tracking-wider">#</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Waktu & Tanggal</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Nama Hewan</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Anamnesa</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Temuan Klinis</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Diagnosa</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Dokter Pemeriksa</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">ID Reservasi</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase w-10 tracking-wider">Aksi</th>
                </tr>
            </thead>

            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">

                @forelse ($rekamMedisS as $index => $rekamMedis)
                    <tr class="text-center">
                        <td class="px-6 py-3">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3">{{ $rekamMedis->created_at }}</td>
                        <td class="px-6 py-3">{{ $rekamMedis->pet->nama }}</td>
                        <td class="px-6 py-3">{{ $rekamMedis->anamnesa }}</td>
                        <td class="px-6 py-3">{{ $rekamMedis->temuan_klinis }}</td>
                        <td class="px-6 py-3">{{ $rekamMedis->diagnosa }}</td>
                        <td class="px-6 py-3">{{ $rekamMedis->roleUser->user->nama}}</td>
                        <td class="px-6 py-3">{{ $rekamMedis->idreservasi_dokter}}</td>

                        <td class="px-6 py-3">
                            <div class="flex gap-2 justify-center">
                                <a href="{{ route('dokter.rekam-medis.detail', $rekamMedis->idrekam_medis) }}"
                                    class="bg-orange-500 text-white px-4 py-1 rounded-lg hover:bg-orange-600 transition">
                                    Detail
                                </a>
                            </div>
                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            Belum ada data.
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>
    </div>
</x-app-layout>