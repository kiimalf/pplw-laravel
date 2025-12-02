<x-app-layout>
    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-6">
        <div class="p-6 text-lg font-semibold text-gray-900 dark:text-gray-100">
            Detail Rekam Medis
        </div>
    </div>

    <div class="mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="rounded-lg dark:bg-gray-800">
                <div class="bg-gray-300 dark:bg-gray-700 text-white font-semibold px-4 py-4 rounded-t-lg">
                    Informasi Pasien
                </div>
                <div class="p-4 space-y-1 text-gray-800 dark:text-gray-200 text-sm">
                    <p><strong>Nama Pet : </strong> {{ $rekamMedis->pet->nama }}</p>
                    <p><strong>Jenis Hewan : </strong> {{ $rekamMedis->pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }}</p>
                    <p><strong>Ras : </strong> {{ $rekamMedis->pet->rasHewan->nama_ras ?? '-' }}</p>
                    <p><strong>Tanggal Lahir : </strong> {{ $rekamMedis->pet->tanggal_lahir }}</p>
                    <p><strong>Jenis Kelamin : </strong> {{ $rekamMedis->pet->jenis_kelamin }}</p>
                    <p><strong>Warna/Tanda : </strong> {{ $rekamMedis->pet->warna_tanda }}</p>
                </div>
            </div>
        
            <div class="rounded-lg  dark:bg-gray-800">
                <div class="bg-gray-300 dark:bg-gray-700 text-white font-semibold px-4 py-4 rounded-t-lg">
                    Informasi Pemeriksaaan
                </div>

                <div class="p-4 space-y-1 text-gray-800 dark:text-gray-200 text-sm">
                    <p><strong>No Urut : </strong> {{ $rekamMedis->temuDokter->no_urut }}</p>
                    <p><strong>Waktu/Tanggal : </strong> {{ $rekamMedis->temuDokter->waktu_daftar }}</p>
                    <p><strong>Dokter Pemeriksa : </strong> {{ $rekamMedis->roleUser->user->nama }}</p>
                    <p><strong>Nama Pemilik : </strong> {{ $rekamMedis->pet->pemilik->user->nama }}</p>
                    <p><strong>Email : </strong> {{ $rekamMedis->pet->pemilik->user->email }}</p>
                    <p><strong>Nomor WA : </strong> {{ $rekamMedis->pet->pemilik->no_wa }}</p>
                    <p><strong>Alamat : </strong> {{ $rekamMedis->pet->pemilik->alamat }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-xl mb-6    ">
        <table class="table-fixed min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-gray-900 dark:text-gray-100">
            <thead class="bg-gray-300 dark:bg-gray-700 ">
                <tr class="text-center">
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Anamnesa</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Temuan Klinis</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Diagnosa</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    <tr class="text-center">
                        <td class="px-6 py-3">{{ $rekamMedis->anamnesa }}</td>
                        <td class="px-6 py-3">{{ $rekamMedis->temuan_klinis }}</td>
                        <td class="px-6 py-3">{{ $rekamMedis->diagnosa }}</td>
                    </tr>
            </tbody>
        </table>
    </div>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-xl mb-6 border-gray-300 dark:border-gray-700 border">
        <div class="bg-gray-300 dark:bg-gray-700 text-white font-semibold px-4 py-4 rounded-t-lg">
            Tindakan & Terapi
        </div>
        <div class="rounded-lg p-3">
            <table class="table-fixed min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-700 border border-radius-xl">
                <thead class="bg-gray-300 dark:bg-gray-700 ">
                    <tr class="text-center">
                        <th class="px-6 py-4 text-xs font-bold uppercase w-10 tracking-wider">#</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Kode</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Deskripsi</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Kategori Klinis</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Detail Tambahan</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($detailRekamMedis as $index => $detail)
                        <tr class="text-center">
                            <td class="px-6 py-3">{{ $loop->iteration }}</td>
                            <td class="px-6 py-3">{{ $detail->kodeTindakanTerapi->kode }}</td>
                            <td class="px-6 py-3">{{ $detail->kodeTindakanTerapi->deskripsi_tindakan_terapi }}</td>
                            <td class="px-6 py-3">{{ $detail->kodeTindakanTerapi->kategori->nama_kategori }}</td>
                            <td class="px-6 py-3">{{ $detail->kodeTindakanTerapi->kategoriKlinis->nama_kategori_klinis }}</td>
                            <td class="px-6 py-3">{{ $detail->detail }}</td>
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
    </div>

</x-app-layout>