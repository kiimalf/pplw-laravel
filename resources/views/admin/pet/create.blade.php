@extends('layouts.lte.main')

@section('content')

{{-- HEADER --}}
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Tambah Pet</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.pet.index') }}">Pet</a></li>
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
            <h3 class="card-title">Form Tambah Pet</h3>
        </div>

        <form action="{{ route('admin.pet.store') }}" method="POST">
            @csrf

            <div class="card-body">

                {{-- PEMILIK --}}
                <div class="form-group mb-3">
                    <label for="idpemilik">Pemilik</label>
                    <select name="idpemilik" id="select-pemilik" 
                        class="form-control @error('idpemilik') is-invalid @enderror">
                        <option value="" disabled selected>-- Cari dan pilih pemilik --</option>

                        @foreach ($pemilik as $item)
                            <option value="{{ $item->idpemilik }}">{{ $item->nama_pemilik }}</option>
                        @endforeach
                    </select>

                    @error('idpemilik')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        $('#select-pemilik').select2({
                            placeholder: "Cari pemilik...",
                            allowClear: true,
                            width: "100%"
                        });
                    });
                </script>


                {{-- NAMA PET --}}
                <div class="form-group mb-3">
                    <label for="nama_pet">Nama Pet</label>
                    <input type="text" 
                           name="nama_pet" 
                           class="form-control @error('nama_pet') is-invalid @enderror"
                           value="{{ old('nama_pet') }}"
                           placeholder="Masukkan Nama Pet">
                    @error('nama_pet')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- TANGGAL LAHIR --}}
                <div class="form-group mb-3">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" 
                           name="tanggal_lahir"
                           class="form-control @error('tanggal_lahir') is-invalid @enderror"
                           value="{{ old('tanggal_lahir') }}">
                    @error('tanggal_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- WARNA TANDA --}}
                <div class="form-group mb-3">
                    <label for="warna_tanda">Warna atau Tanda</label>
                    <input type="text" 
                           name="warna_tanda"
                           class="form-control @error('warna_tanda') is-invalid @enderror"
                           value="{{ old('warna_tanda') }}"
                           placeholder="Masukkan warna atau tanda pada hewan">
                    @error('warna_tanda')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- RAS HEWAN --}}
                <div class="form-group mb-3">
                    <label for="idras_hewan">Ras Hewan</label>
                    <select name="idras_hewan" class="form-control @error('idras_hewan') is-invalid @enderror">
                        <option value="" disabled selected>-- Pilih Ras Hewan --</option>

                        @foreach ($rasHewan as $item)
                            <option value="{{ $item->idras_hewan }}">
                                {{ $item->nama_ras }} ({{ $item->nama_jenis_hewan }})
                            </option>
                        @endforeach

                    </select>
                    @error('idras_hewan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- JENIS KELAMIN --}}
                <div class="form-group mb-3">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" 
                            class="form-control @error('jenis_kelamin') is-invalid @enderror">
                        <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                        <option value="0">Jantan</option>
                        <option value="1">Betina</option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            {{-- FOOTER --}}
            <div class="card-footer d-flex justify-content-end gap-2">
                <a href="{{ route('admin.pet.index') }}" class="btn btn-secondary">
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
