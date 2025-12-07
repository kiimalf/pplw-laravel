@extends('layouts.lte.main')

@section('content')

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">
                    Edit Tindakan Terapi — Kode: {{ $kodeTindakanTerapi->kode }}
                </h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.tindakan-terapi.index') }}">Tindakan Terapi</a></li>
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
            <h3 class="card-title">Form Edit Tindakan Terapi</h3>
        </div>

        <form action="{{ route('admin.tindakan-terapi.update', $kodeTindakanTerapi->idkode_tindakan_terapi) }}" method="POST">
            @csrf

            <div class="card-body">

                {{-- KODE --}}
                <div class="form-group mb-3">
                    <label>Kode</label>
                    <input type="text"
                        name="kode"
                        class="form-control @error('kode') is-invalid @enderror"
                        value="{{ old('kode', $kodeTindakanTerapi->kode) }}">
                    @error('kode')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- KATEGORI --}}
                <div class="form-group mb-3">
                    <label>Kategori</label>
                    <select name="idkategori"
                        class="form-control @error('idkategori') is-invalid @enderror">
                        
                        <option value="{{ $kodeTindakanTerapi->idkategori }}" selected>
                            {{ $kodeTindakanTerapi->nama_kategori }}
                        </option>

                        @foreach ($kategori as $item)
                            <option value="{{ $item->idkategori }}">
                                {{ $item->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('idkategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- KATEGORI KLINIS --}}
                <div class="form-group mb-3">
                    <label>Kategori Klinis</label>
                    <select name="idkategori_klinis"
                        class="form-control @error('idkategori_klinis') is-invalid @enderror">

                        <option value="{{ $kodeTindakanTerapi->idkategori_klinis }}" selected>
                            {{ $kodeTindakanTerapi->nama_kategori_klinis }}
                        </option>

                        @foreach ($kategoriKlinis as $item)
                            <option value="{{ $item->idkategori_klinis }}">
                                {{ $item->nama_kategori_klinis }}
                            </option>
                        @endforeach
                    </select>
                    @error('idkategori_klinis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- DESKRIPSI --}}
                <div class="form-group mb-3">
                    <label>Deskripsi Tindakan</label>
                    <input type="text"
                        name="deskripsi_tindakan_terapi"
                        class="form-control @error('deskripsi_tindakan_terapi') is-invalid @enderror"
                        value="{{ old('deskripsi_tindakan_terapi', $kodeTindakanTerapi->deskripsi_tindakan_terapi) }}">
                    @error('deskripsi_tindakan_terapi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="card-footer d-flex justify-content-end gap-2">
                <a href="{{ route('admin.tindakan-terapi.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-warning text-white">
                    <i class="fas fa-edit"></i> Update
                </button>
            </div>

        </form>
    </div>

</div>
</div>

@endsection
