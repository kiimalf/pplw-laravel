@extends('layouts.lte.main')

@section('content')

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Tambah Kategori Klinis</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.kategori-klinis.index') }}">Kategori Klinis</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
<div class="container-fluid">

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Form Tambah Kategori Klinis</h3>
        </div>

        <form action="{{ route('admin.kategori-klinis.store') }}" method="POST">
            @csrf

            <div class="card-body">

                {{-- NAMA --}}
                <div class="form-group mb-3">
                    <label>Nama Kategori Klinis</label>
                    <input type="text"
                        name="nama_kategori_klinis"
                        class="form-control @error('nama_kategori_klinis') is-invalid @enderror"
                        placeholder="Masukkan kategori klinis"
                        value="{{ old('nama_kategori_klinis') }}">
                    @error('nama_kategori_klinis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="card-footer d-flex justify-content-end gap-2">
                <a href="{{ route('admin.kategori-klinis.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>

        </form>
    </div>

</div>
</div>

@endsection
