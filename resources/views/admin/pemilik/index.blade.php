@extends('layouts.lte.main')

@section('content')

    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Pemilik</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pemilik</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">

            <div class="row mb-3">
                <div class="col text-end">
                    <a href="{{ route('admin.pemilik.create') }}" class="btn btn-primary">
                        + Tambah Pemilik
                    </a>
                </div>
            </div>

            <!--begin::Row-->
            <div class="row">
                <div class="col-md-12">

                    <div class="card mb-4">

                        <div class="card-header">
                            <h3 class="card-title">Tabel Data Pemilik</h3>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th style="width: 32px">#</th>
                                        <th>Nama Pemilik</th>
                                        <th>Email</th>
                                        <th>No WA</th>
                                        <th>Alamat</th>
                                        <th style="width: 120px">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($pemiliks as $pemilik)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pemilik->nama }}</td>
                                            <td>{{ $pemilik->email }}</td>
                                            <td>{{ $pemilik->no_wa }}</td>
                                            <td>{{ $pemilik->alamat }}</td>

                                            <td>
                                                <a href="{{ route('admin.pemilik.edit', $pemilik->idpemilik) }}"
                                                    class="btn btn-sm btn-warning">
                                                    Edit
                                                </a>

                                                <form action="{{ route('admin.pemilik.delete', $pemilik->idpemilik) }}"
                                                    method="POST"
                                                    style="display: inline-block;"
                                                    onsubmit="return confirm('Yakin ingin menghapus Pemilik ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">
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

                        {{-- OPTIONAL PAGINATION (hidupkan jika perlu) --}}
                        {{-- <div class="card-footer clearfix">
                            {{ $pemiliks->links() }}
                        </div> --}}

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
