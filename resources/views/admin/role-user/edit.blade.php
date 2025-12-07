@extends('layouts.lte.main')

@section('content')

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Edit Role — {{ $user->nama }}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">User</a></li>
                    <li class="breadcrumb-item active">Edit Role</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
<div class="container-fluid">

    {{-- ========== CARD TABEL ROLE USER ========== --}}
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <h3 class="card-title">Daftar Role yang Dimiliki: {{ $user->nama }}</h3>
        </div>

        <div class="card-body p-0">
            <table class="table table-bordered table-hover text-center mb-0">
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th width="200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roleUser as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->nama_role }}</td>
                            <td>
                                @if ($row->status == 1)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Tidak Aktif</span>
                                @endif
                            </td>

                            <td>
                                <div class="d-flex justify-content-center gap-2">

                                    {{-- UPDATE STATUS --}}
                                    <form action="{{ route('admin.role-user.updateStatus', $row->idrole_user) }}"
                                          method="POST">
                                        @csrf
                                        <button class="btn btn-warning btn-sm">
                                            Ubah Status
                                        </button>
                                    </form>

                                    {{-- DELETE ROLE --}}
                                    <form action="{{ route('admin.role-user.delete', $row->idrole_user) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus role ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-muted py-3">Belum ada role untuk user ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ========== CARD TAMBAH ROLE ========== --}}
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Tambah Role ke User</h3>
        </div>

        <form action="{{ route('admin.role-user.store', $user->iduser) }}" method="POST">
            @csrf

            <div class="card-body">

                <input type="hidden" name="iduser" value="{{ $user->iduser }}">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Pilih Role</label>
                        <select name="idrole" class="form-control" required>
                            <option value="" disabled selected>-- Pilih Role --</option>
                            @foreach($role as $data)
                                <option value="{{ $data->idrole }}">{{ $data->nama_role }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 d-flex align-items-end mb-3">
                        <button class="btn btn-success w-100">
                            Tambah
                        </button>
                    </div>

                </div>

                {{-- Error Message --}}
                @if ($errors->any())
                <div class="alert alert-danger mt-2">
                    <ul class="m-0 ps-3">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

            </div>

        </form>
    </div>

</div>
</div>

@endsection
