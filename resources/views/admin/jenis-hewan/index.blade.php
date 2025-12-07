
@extends('layouts.lte.main')

@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Jenis Hewan</h3></div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                <li class="breadcrumb-item active" aria-current="page">Jenis Hewan</li>
            </ol>
            </div>
        </div>
        <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col text-end">
                    <a href="{{ route('admin.jenis-hewan.create') }}" class="btn btn-primary">
                        + Tambah Jenis Hewan
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h3 class="card-title">Tabel Data Jenis Hewan</h3></div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th style="width: 32px">#</th>
                                <th>Nama Jenis</th>
                                <th style="width: 120px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jenisHewans as $index => $jenishewan)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $jenishewan->nama_jenis_hewan }}</td>
                                    <td>
                                        <a href="{{ route('admin.jenis-hewan.edit', $jenishewan->idjenis_hewan) }}"
                                            class="btn btn-warning btn-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.jenis-hewan.delete', $jenishewan->idjenis_hewan) }}"
                                            method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus Jenis Hewan ini?');">
                                                Hapus
                                            </button>
                                        </form>
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
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-end">
                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

@endsection