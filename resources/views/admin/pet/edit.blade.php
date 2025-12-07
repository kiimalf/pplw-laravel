@extends('layouts.lte.main')

@section('content')

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Edit Pet {{ $pet->nama }}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Data Pet</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.pet.index') }}">Pet</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
<div class="container-fluid">

    @php
        // ambil nama pemilik (karena controller tidak mengirimkan)
        $namaPemilik = DB::table('pemilik')
            ->join('user', 'user.iduser', '=', 'pemilik.iduser')
            ->where('pemilik.idpemilik', $pet->idpemilik)
            ->value('user.nama');

        // ambil nama ras (karena controller tidak mengirimkan)
        $namaRas = DB::table('ras_hewan')
            ->where('idras_hewan', $pet->idras_hewan)
            ->value('nama_ras');
    @endphp

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Form Edit Pet</h3>
        </div>

        <form action="{{ route('admin.pet.update', $pet->idpet) }}" method="POST">
            @csrf

            <div class="card-body">

                {{-- PEMILIK (TIDAK BISA DIEDIT) --}}
                <div class="form-group mb-3">
                    <label>Pemilik</label>
                    <input type="text" class="form-control" value="{{ $namaPemilik }}" disabled>
                </div>

                {{-- NAMA PET --}}
                <div class="form-group mb-3">
                    <label>Nama Pet</label>
                    <input type="text" name="nama_pet"
                        class="form-control @error('nama_pet') is-invalid @enderror"
                        placeholder="{{ $pet->nama }}">
                    @error('nama_pet')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- TANGGAL LAHIR --}}
                <div class="form-group mb-3">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir"
                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                        value="{{ $pet->tanggal_lahir }}">
                    @error('tanggal_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- WARNA TANDA --}}
                <div class="form-group mb-3">
                    <label>Warna Tanda</label>
                    <input type="text" name="warna_tanda"
                        class="form-control @error('warna_tanda') is-invalid @enderror"
                        placeholder="{{ $pet->warna_tanda }}">
                    @error('warna_tanda')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- RAS HEWAN --}}
                <div class="form-group mb-3">
                    <label>Ras Hewan</label>

                    <select name="idras_hewan" class="form-control select2 @error('idras_hewan') is-invalid @enderror">
                        <option value="{{ $pet->idras_hewan }}" selected>
                            {{ $namaRas }} (Saat ini)
                        </option>
                        @foreach ($rasHewan as $item)
                            <option value="{{ $item->idras_hewan }}">
                                {{ $item->nama_ras }}
                            </option>
                        @endforeach
                    </select>

                    @error('idras_hewan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- JENIS KELAMIN --}}
                <div class="form-group mb-3">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                        <option value="0" {{ $pet->jenis_kelamin == 0 ? 'selected' : '' }}>Jantan</option>
                        <option value="1" {{ $pet->jenis_kelamin == 1 ? 'selected' : '' }}>Betina</option>
                    </select>
                </div>

            </div>

            <div class="card-footer d-flex justify-content-end gap-2">
                <a href="{{ route('admin.pet.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

</div>
</div>

@endsection

@section('scripts')
<script>
    $('.select2').select2({
        width: '100%',
        theme: 'bootstrap4'
    });
</script>
@endsection
