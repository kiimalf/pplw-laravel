{{-- <x-app-layout>
    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-6">
        <div class="p-6 text-lg font-semibold text-gray-900 dark:text-gray-100">
            Data Rekam Medis
        </div>
    </div>
    <div class="mb-4 flex justify-end items-center gap-4">

        <a href=" {{ route('admin.rekam-medis.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            + Tambah Rekam
        </a>
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

                                <a href="{{ route('admin.rekam-medis.detail', $rekamMedis->idrekam_medis) }}"
                                    class="bg-orange-500 text-white px-4 py-1 rounded-lg hover:bg-orange-600 transition">
                                    detail
                                </a>

                                <form action="{{ route('admin.rekam-medis.delete', $rekamMedis->idrekam_medis) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus role ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="bg-red-600 text-white px-4 py-1 rounded-lg hover:bg-red-700">
                                        Hapus
                                    </button>
                                </form>

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
</x-app-layout> --}}

@extends('layouts.lte.main')

@section('content')

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Data Rekam Medis</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Rekam Medis</a></li>
                    <li class="breadcrumb-item active">Data Rekam Medis</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">

        <div class="row mb-3">
            <div class="col text-end">
                <a href="{{ route('admin.rekam-medis.create') }}" class="btn btn-primary">
                    + Tambah Rekam
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3 class="card-title">Tabel Rekam Medis</h3></div>

            <div class="card-body">
                <table class="table table-bordered table-hover table-sm align-middle">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Nama Pet</th>
                            <th>Anamnesa</th>
                            <th>Temuan Klinis</th>
                            <th>Diagnosa</th>
                            <th>Dokter</th>
                            <th>ID Reservasi</th>
                            <th style="width: 120px">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($rekamMedisS as $row)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->created_at }}</td>
                            <td>{{ $row->nama_pet }}</td>
                            <td>{{ $row->anamnesa }}</td>
                            <td>{{ $row->temuan_klinis }}</td>
                            <td>{{ $row->diagnosa }}</td>
                            <td>{{ $row->nama_dokter }}</td>
                            <td>{{ $row->idreservasi_dokter }}</td>

                            <td>
                                <a href="{{ route('admin.rekam-medis.detail', $row->idrekam_medis) }}"
                                    class="btn btn-info btn-sm">Detail</a>

                                <form action="{{ route('admin.rekam-medis.delete', $row->idrekam_medis) }}"
                                      method="POST"
                                      style="display:inline-block;"
                                      onsubmit="return confirm('Hapus rekam medis ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="9" class="text-center text-muted">Belum ada data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>

@endsection
