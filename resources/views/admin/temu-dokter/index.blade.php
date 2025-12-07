{{-- <x-app-layout>
    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-6">
        <div class="p-6 text-lg font-semibold text-gray-900 dark:text-gray-100">
            Data Temu Dokter
        </div>
    </div>
    <div class="mb-4 flex justify-end items-center gap-4">

        <a href="{{ route('admin.temu-dokter.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            + Tambah Temu Dokter
        </a>
    </div>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-xl">
        <table class="table-fixed min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-gray-900 dark:text-gray-100">

            <thead class="bg-gray-300 dark:bg-gray-700 ">
                <tr class="text-center">
                    <th class="px-6 py-4 text-xs font-bold uppercase w-10 tracking-wider">#</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">no_urut</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Waktu Daftar</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Nama Pet</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Nama Dokter</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase w-10 tracking-wider">Aksi</th>
                </tr>
            </thead>

            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">

                @forelse ($temuDokters as $index => $temuDokter)
                    <tr class="text-center">

                        <td class="px-6 py-3">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3">{{ $temuDokter->no_urut }}</td>
                        <td class="px-6 py-3">{{ $temuDokter->waktu_daftar }}</td>
                        <td class="px-6 py-3">{{ $temuDokter->pet->nama }}</td>
                        <td class="px-6 py-3">{{ $temuDokter->roleUser->user->nama }}</td>
                        <td class="px-6 py-3">{{ $temuDokter->status }}</td>
                        

                        <td class="px-6 py-3">
                            <div class="flex gap-2 justify-center">

                                <a href="{{ route('admin.temu-dokter.edit', $temuDokter->idreservasi_dokter) }}"
                                    class="bg-orange-500 text-white px-4 py-1 rounded-lg hover:bg-orange-600 transition">
                                    Edit
                                </a>

                                <form action="{{ route('admin.temu-dokter.delete', $temuDokter->idreservasi_dokter) }}"
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
            <div class="col-sm-6"><h3 class="mb-0">Data Temu Dokter</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                    <li class="breadcrumb-item active">Temu Dokter</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">

        <div class="row mb-3">
            <div class="col text-end">
                <a href="{{ route('admin.temu-dokter.create') }}" class="btn btn-primary">
                    + Tambah Temu Dokter
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3 class="card-title">Tabel Temu Dokter</h3></div>

            <div class="card-body">
                <table class="table table-bordered table-hover table-sm align-middle">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>No Urut</th>
                            <th>Waktu Daftar</th>
                            <th>Nama Pet</th>
                            <th>Nama Dokter</th>
                            <th>Status</th>
                            <th style="width: 120px">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($temuDokters as $row)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->no_urut }}</td>
                            <td>{{ $row->waktu_daftar }}</td>
                            <td>{{ $row->nama_pet }}</td>
                            <td>{{ $row->nama_dokter }}</td>
                            <td>
                                @if ($row->status == 1)
                                    <span class="badge bg-success">Selesai</span>
                                @else
                                    <span class="badge bg-secondary">Menunggu</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('admin.temu-dokter.edit', $row->idreservasi_dokter) }}"
                                    class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('admin.temu-dokter.delete', $row->idreservasi_dokter) }}"
                                      method="POST"
                                      style="display:inline-block;"
                                      onsubmit="return confirm('Hapus temu dokter ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>

                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center text-muted">Belum ada data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>

@endsection
