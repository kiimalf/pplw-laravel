@extends('layouts.lte.main')

@section('content')

{{-- HEADER --}}
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Edit Pemilik - {{ $user->nama }}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.pemilik.index') }}">Pemilik</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

{{-- CONTENT --}}
<div class="app-content">
<div class="container-fluid">

    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Form Edit Pemilik</h3>
        </div>

        <form action="{{ route('admin.pemilik.update', $pemilik->idpemilik) }}" method="POST">
            @csrf

            <div class="card-body">

                {{-- NAMA --}}
                <div class="form-group mb-3">
                    <label for="nama">Nama</label>
                    <input type="text"
                        name="nama"
                        class="form-control @error('nama') is-invalid @enderror"
                        value="{{ old('nama', $user->nama) }}"
                        placeholder="Masukkan nama lengkap">

                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- EMAIL --}}
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}"
                        placeholder="Masukkan email">

                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- NO WA --}}
                <div class="form-group mb-3">
                    <label for="no_wa">Nomor WA</label>
                    <input type="text"
                        name="no_wa"
                        class="form-control @error('no_wa') is-invalid @enderror"
                        value="{{ old('no_wa', $pemilik->no_wa) }}"
                        placeholder="Masukkan nomor WhatsApp">

                    @error('no_wa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ALAMAT --}}
                <div class="form-group mb-3">
                    <label for="alamat">Alamat</label>
                    <input type="text"
                        name="alamat"
                        class="form-control @error('alamat') is-invalid @enderror"
                        value="{{ old('alamat', $pemilik->alamat) }}"
                        placeholder="Masukkan alamat lengkap">

                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            {{-- FOOTER BUTTON --}}
            <div class="card-footer d-flex gap-2 justify-content-end">
                <a href="{{ route('admin.pemilik.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>

        </form>
    </div>

</div>
</div>

@endsection
