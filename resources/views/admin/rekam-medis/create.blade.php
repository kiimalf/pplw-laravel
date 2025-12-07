@extends('layouts.lte.main')

@section('content')

{{-- HEADER --}}
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Tambah Rekam Medis</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Rekam Medis</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.rekam-medis.index') }}">Data Rekam Medis</a>
                    </li>
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
            <h3 class="card-title">Form Tambah Rekam Medis</h3>
        </div>

        <form action="{{ route('admin.rekam-medis.store') }}" method="POST">
            @csrf

            <div class="card-body">

                {{-- RESERVASI --}}
                <div class="form-group mb-3">
                    <label>Reservasi</label>
                    <select name="idreservasi_dokter"
                            class="form-control @error('idreservasi_dokter') is-invalid @enderror">
                        <option value="" disabled selected>Pilih Reservasi</option>

                        @foreach ($reservasi as $item)
                            <option value="{{ $item->idreservasi_dokter }}">
                                {{ $item->idreservasi_dokter }} — {{ $item->nama_pet }}
                            </option>
                        @endforeach
                    </select>
                    @error('idreservasi_dokter')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ANAMNESA --}}
                <div class="form-group mb-3">
                    <label>Anamnesa</label>
                    <input type="text"
                        name="anamnesa"
                        class="form-control @error('anamnesa') is-invalid @enderror"
                        placeholder="Masukkan anamnesa">
                    @error('anamnesa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- TEMUAN KLINIS --}}
                <div class="form-group mb-3">
                    <label>Temuan Klinis</label>
                    <input type="text"
                        name="temuan_klinis"
                        class="form-control @error('temuan_klinis') is-invalid @enderror"
                        placeholder="Masukkan temuan klinis">
                    @error('temuan_klinis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- DIAGNOSA --}}
                <div class="form-group mb-3">
                    <label>Diagnosa</label>
                    <input type="text"
                        name="diagnosa"
                        class="form-control @error('diagnosa') is-invalid @enderror"
                        placeholder="Masukkan diagnosa">
                    @error('diagnosa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- DOKTER PEMERIKSA --}}
                <div class="form-group mb-3">
                    <label>Dokter Pemeriksa</label>
                    <select name="dokter_pemeriksa"
                            class="form-control @error('dokter_pemeriksa') is-invalid @enderror">
                        <option value="" disabled selected>Pilih Dokter</option>

                        @foreach ($dokter as $item)
                            <option value="{{ $item->idrole_user }}">
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('dokter_pemeriksa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            {{-- FOOTER --}}
            <div class="card-footer d-flex justify-content-end gap-2">
                <a href="{{ route('admin.rekam-medis.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

                <button class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>

        </form>
    </div>

</div>
</div>

@endsection
