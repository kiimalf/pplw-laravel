@extends('layouts.lte.main')

@section('content')

{{-- HEADER --}}
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Tambah Temu Dokter</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Rekam Medis</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.temu-dokter.index') }}">Temu Dokter</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>
        </div>
    </div>
</div>

{{-- CONTENT --}}
<div class="app-content">
<div class="container-fluid">

    <div class="card card-primary">

        <div class="card-header">
            <h3 class="card-title">Form Tambah Temu Dokter</h3>
        </div>

        <form action="{{ route('admin.temu-dokter.store') }}" method="POST">
            @csrf

            <div class="card-body">

                {{-- NO URUT --}}
                <div class="form-group mb-3">
                    <label>No Urut</label>
                    <input 
                        type="text" 
                        name="no_urut" 
                        value="{{ old('no_urut') }}"
                        class="form-control @error('no_urut') is-invalid @enderror" 
                        placeholder="Masukkan nomor urut">
                    @error('no_urut')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- PET --}}
                <div class="form-group mb-3">
                    <label>Pet</label>
                    <select 
                        name="idpet" 
                        class="form-control @error('idpet') is-invalid @enderror">
                        <option value="" disabled selected>Pilih Pet</option>

                        @foreach ($pets as $pet)
                            <option value="{{ $pet->idpet }}">
                                {{ $pet->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('idpet')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- DOKTER --}}
                <div class="form-group mb-3">
                    <label>Dokter</label>
                    <select 
                        name="idrole_user" 
                        class="form-control @error('idrole_user') is-invalid @enderror">
                        <option value="" disabled selected>Pilih Dokter</option>

                        @foreach ($dokters as $dokter)
                            <option value="{{ $dokter->idrole_user }}">
                                {{ $dokter->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('idrole_user')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            {{-- FOOTER --}}
            <div class="card-footer d-flex justify-content-end gap-2">
                <a href="{{ route('admin.temu-dokter.index') }}" class="btn btn-secondary">
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
