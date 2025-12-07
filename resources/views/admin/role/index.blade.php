@extends('layouts.lte.main')

@section('content')
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Role</h3></div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                <li class="breadcrumb-item active" aria-current="page">Role</li>
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
                    <a href="{{ route('admin.role.create') }}" class="btn btn-primary">
                        + Tambah Role
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h3 class="card-title">Tabel Data Role</h3></div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th style="width: 32px">#</th>
                                <th>Nama Role</th>
                                <th style="width: 120px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $index => $role)
                                <tr class="text-center">

                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->nama_role }}</td>

                                    <td> 
                                        <a href="{{ route('admin.role.edit', $role->idrole) }}"
                                            class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.role.delete', $role->idrole) }}"
                                            method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus role ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
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