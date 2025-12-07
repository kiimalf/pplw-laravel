@extends('layouts.lte.main')

@section('content')

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Edit Jenis Hewan</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.jenis-hewan.index') }}">Jenis Hewan</a></li>
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
            <h3 class="card-title">Edit Jenis Hewan: {{ $jenisHewan->nama_jenis_hewan }}</h3>
        </div>

        <form action="{{ route('admin.jenis-hewan.update', $jenisHewan->idjenis_hewan) }}" method="POST">
            @csrf

            <div class="card-body">

                {{-- Nama Jenis Hewan --}}
                <div class="mb-3">
                    <label class="form-label">Nama Jenis Hewan</label>
                    <input type="text" name="nama_jenis_hewan"
                           class="form-control"
                           value="{{ $jenisHewan->nama_jenis_hewan }}">
                </div>

                {{-- Error --}}
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

            <div class="card-footer d-flex justify-content-end">
                <a href="{{ route('admin.jenis-hewan.index') }}" class="btn btn-secondary">
                    Kembali
                </a>

                <button class="btn btn-warning">
                    Update
                </button>
            </div>

        </form>
    </div>

</div>
</div>

@endsection
