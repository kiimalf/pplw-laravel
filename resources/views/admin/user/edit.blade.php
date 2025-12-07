@extends('layouts.lte.main')

@section('content')

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Edit User - {{ $user->nama }}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">User</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
<div class="container-fluid">

    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Form Edit User</h3>
        </div>

        <form action="{{ route('admin.user.update', $user->iduser) }}" method="POST">
            @csrf

            <div class="card-body">

                {{-- NAMA --}}
                <div class="form-group mb-3">
                    <label>Nama</label>
                    <input type="text" 
                           name="nama" 
                           class="form-control @error('nama') is-invalid @enderror"
                           value="{{ old('nama', $user->nama) }}"
                           placeholder="Masukkan nama">

                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- EMAIL --}}
                <div class="form-group mb-3">
                    <label>Email</label>
                    <input type="email" 
                           name="email" 
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $user->email) }}"
                           placeholder="Masukkan email">

                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- PASSWORD --}}
                <div class="form-group mb-3">
                    <label>Password (kosongkan jika tidak diganti)</label>
                    <input type="password" 
                           name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="********">

                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end">

                <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-save"></i> Update
                </button>

            </div>

        </form>
    </div>

</div>
</div>

@endsection
