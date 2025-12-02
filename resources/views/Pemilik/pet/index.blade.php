<x-app-layout>
    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-6">
        <div class="p-6 text-lg font-semibold text-gray-900 dark:text-gray-100">
            Data Pet
        </div>
    </div>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-xl">
        <table class="table-fixed min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-gray-900 dark:text-gray-100">
            <thead class="bg-gray-300 dark:bg-gray-700 ">
                <tr class="text-center">
                    <th class="px-6 py-4 text-xs font-bold uppercase w-10 tracking-wider">#</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Nama Pet</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Tanggal Lahir</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Warna Tanda</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Jenis Kelamin</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">jenis Hewan</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Ras Hewan</th>
                </tr>
            </thead>

            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($pets as $index => $pet)
                    <tr class="text-center">
                        <td class="px-6 py-3">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3">{{ $pet->nama }}</td>
                        <td class="px-6 py-3">{{ $pet->tanggal_lahir }}</td>
                        <td class="px-6 py-3">{{ $pet->warna_tanda }}</td>
                        <td class="px-6 py-3">
                            @if ( $pet->jenis_kelamin == '0')
                                Jantan
                            @elseif ($pet->jenis_kelamin == '1')
                                Betina
                            @endif
                        </td>
                        <td class="px-6 py-3">{{ $pet->rasHewan->jenisHewan->nama_jenis_hewan }}</td>
                        <td class="px-6 py-3">{{ $pet->rasHewan->nama_ras }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            Belum ada data.
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>
    </div>
</x-app-layout>