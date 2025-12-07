{{-- <x-app-layout>
    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-6">
        <div class="p-6 text-lg font-semibold text-gray-900 dark:text-gray-100">
            Data Kode Tindakan Terapi
        </div>
    </div>
    <div class="mb-4 flex justify-end items-center gap-4">

        <a href="{{ route('admin.tindakan-terapi.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            + Tambah Kode Tindakan Terapi
        </a>
    </div>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-xl">
        <table class="table-fixed min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-gray-900 dark:text-gray-100">

            <thead class="bg-gray-300 dark:bg-gray-700 ">
                <tr class="text-center">
                    <th class="px-6 py-4 text-xs font-bold uppercase w-10 tracking-wider">#</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Kode</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Deskripsi Tindakan Terapi</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Kategori Klinis</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase w-10 tracking-wider">Aksi</th>
                </tr>
            </thead>

            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">

                @forelse ($kodeTindakanTerapi as $index => $item)
                    <tr class="text-center">

                        <td class="px-6 py-3">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3">{{ $item->kode }}</td>
                        <td class="px-6 py-3">{{ $item->deskripsi_tindakan_terapi }}</td>
                        <td class="px-6 py-3">{{ $item->kategori->nama_kategori }}</td>
                        <td class="px-6 py-3">{{ $item->kategoriKlinis->nama_kategori_klinis }}</td>

                        <td class="px-6 py-3">
                            <div class="flex gap-2 justify-center">

                                <a href="{{ route('admin.tindakan-terapi.edit', $item->idkode_tindakan_terapi) }}"
                                    class="bg-orange-500 text-white px-4 py-1 rounded-lg hover:bg-orange-600 transition">
                                    Edit
                                </a>

                                <form action="{{ route('admin.tindakan-terapi.delete', $item->idkode_tindakan_terapi) }}"
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
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
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

    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Kode Tindakan & Terapi</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kode Tindakan Terapi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">

            <!-- Tombol Tambah -->
            <div class="row mb-3">
                <div class="col-12 text-end">
                    <a href="{{ route('admin.tindakan-terapi.create') }}"
                        class="btn btn-primary">
                        + Tambah Kode Tindakan Terapi
                    </a>
                </div>
            </div>

            <!--begin::Row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">

                        <div class="card-header">
                            <h3 class="card-title">Tabel Kode Tindakan Terapi</h3>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th style="width: 32px">#</th>
                                        <th>Kode</th>
                                        <th>Deskripsi</th>
                                        <th>Kategori</th>
                                        <th>Kategori Klinis</th>
                                        <th style="width: 120px">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($kodeTindakanTerapi as $item)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->kode }}</td>
                                            <td>{{ $item->deskripsi_tindakan_terapi }}</td>
                                            <td>{{ $item->nama_kategori }}</td>
                                            <td>{{ $item->nama_kategori_klinis }}</td>

                                            <td>
                                                <a href="{{ route('admin.tindakan-terapi.edit', $item->idkode_tindakan_terapi) }}"
                                                    class="btn btn-sm btn-warning">
                                                    Edit
                                                </a>

                                                <form action="{{ route('admin.tindakan-terapi.delete', $item->idkode_tindakan_terapi) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">
                                                Belum ada data.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer clearfix">
                            {{-- Jika pakai pagination, tampilkan di sini --}}
                            {{-- {{ $kodeTindakanTerapi->links() }} --}}
                        </div>

                    </div>
                </div>
            </div>
            <!--end::Row-->

        </div>
    </div>
    <!--end::App Content-->

@endsection
