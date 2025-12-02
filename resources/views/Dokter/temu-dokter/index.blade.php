<x-app-layout>
    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-6">
        <div class="p-6 text-lg font-semibold text-gray-900 dark:text-gray-100">
            Data Temu Dokter
        </div>
    </div>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-xl">
        <table class="table-fixed min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-gray-900 dark:text-gray-100">

            <thead class="bg-gray-300 dark:bg-gray-700 ">
                <tr class="text-center">
                    <th class="px-6 py-4 text-xs font-bold uppercase w-10 tracking-wider">#</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">no_urut</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Waktu Daftar</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Nama Pet</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Pemilik</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Nama Dokter</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($temuDokters as $index => $temuDokter)
                    <tr class="text-center">
                        <td class="px-6 py-3">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3">{{ $temuDokter->no_urut }}</td>
                        <td class="px-6 py-3">{{ $temuDokter->waktu_daftar }}</td>
                        <td class="px-6 py-3">{{ $temuDokter->pet->nama }}</td>
                        <td class="px-6 py-3">{{ $temuDokter->pet->pemilik->user->nama }}</td>
                        <td class="px-6 py-3">{{ $temuDokter->roleUser->user->nama }}</td>
                        <td class="px-6 py-3">{{ $temuDokter->status }}</td>
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