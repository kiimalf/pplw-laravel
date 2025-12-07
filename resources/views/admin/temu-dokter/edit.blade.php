@extends('layouts.lte.main')

@section('content')

{{-- HEADER --}}
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Edit Temu Dokter – Pet: {{ $temuDokter->nama_pet }}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Rekam Medis</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.temu-dokter.index') }}">Temu Dokter</a></li>
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
            <h3 class="card-title">Form Edit Temu Dokter</h3>
        </div>

        <form action="{{ route('admin.temu-dokter.update', $temuDokter->idreservasi_dokter) }}" method="POST">
            @csrf

            <div class="card-body">

                {{-- NO URUT --}}
                <div class="form-group mb-3">
                    <label>No Urut</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        value="{{ $temuDokter->no_urut }}" 
                        disabled>
                </div>

                {{-- PET --}}
                <div class="form-group mb-3">
                    <label>Pet</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        value="{{ $temuDokter->nama_pet }}" 
                        disabled>
                </div>

                {{-- DOKTER --}}
                <div class="form-group mb-3">
                    <label>Dokter</label>
                    <select name="idrole_user" class="form-control @error('idrole_user') is-invalid @enderror">
                        <option value="{{ $temuDokter->idrole_user }}" selected>
                            {{ $temuDokter->nama_dokter }}
                        </option>

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

                {{-- STATUS --}}
                <div class="form-group mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                        @if ($temuDokter->status == 0)
                            <option value="0" selected>Menunggu</option>
                            <option value="1">Selesai</option>
                        @else
                            <option value="1" selected>Selesai</option>
                            <option value="0">Menunggu</option>
                        @endif
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            {{-- FOOTER --}}
            <div class="card-footer d-flex justify-content-end gap-2">
                <a href="{{ route('admin.temu-dokter.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-save"></i> Update
                </button>
            </div>
{{--  --}}
        </form>
    </div>

</div>
</div>

@endsection
{{--  --}}