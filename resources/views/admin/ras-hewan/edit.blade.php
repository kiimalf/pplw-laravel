@extends('layouts.lte.main')

@section('content')

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Edit Ras Hewan</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.ras-hewan.index') }}">Ras Hewan</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
<div class="container-fluid">

    <div class="card card-warning card-outline">

        <div class="card-header">
            <h3 class="card-title">Edit: {{ $rasHewan->nama_ras }}</h3>
        </div>

        <form action="{{ route('admin.ras-hewan.update', $rasHewan->idras_hewan) }}" method="POST">
            @csrf

            <div class="card-body">

                {{-- Nama Ras --}}
                <div class="mb-3">
                    <label class="form-label">Nama Ras</label>
                    <input type="text"
                        name="nama_ras"
                        value="{{ $rasHewan->nama_ras }}"
                        class="form-control">
                </div>

                {{-- Jenis Hewan --}}
                <div class="mb-3">
                    <label class="form-label">Jenis Hewan</label>
                    <select name="jenis_hewan" class="form-control">

                        {{-- Jenis Hewan Yang Saat Ini --}}
                        <option value="{{ $rasHewan->idjenis_hewan }}" selected>
                            {{ $rasHewan->nama_jenis_hewan }}
                        </option>

                        {{-- Jenis Hewan Lain --}}
                        @foreach ($jenisHewan as $item)
                            <option value="{{ $item->idjenis_hewan }}">
                                {{ $item->nama_jenis_hewan }}
                            </option>
                        @endforeach

                    </select>
                </div>

                {{-- Error Message --}}
                @if ($errors->any())
                    <div class="alert alert-danger mt-2">
                        <ul class="ps-3 m-0">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>

            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('admin.ras-hewan.index') }}" class="btn btn-secondary">Kembali</a>
                <button class="btn btn-warning">Update</button>
            </div>

        </form>
    </div>

</div>
</div>

@endsection
