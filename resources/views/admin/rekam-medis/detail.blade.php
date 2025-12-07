@extends('layouts.lte.main')

@section('content')

{{-- HEADER --}}
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Detail Rekam Medis</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Rekam Medis</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.rekam-medis.index') }}">Data Rekam Medis</a>
                    </li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </div>
        </div>
    </div>
</div>


<div class="app-content">
<div class="container-fluid">

    {{-- INFORMASI PASIEN & PEMERIKSAAN --}}
    <div class="row">

        {{-- INFORMASI PASIEN --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-secondary">
                    <h3 class="card-title text-white">Informasi Pasien</h3>
                </div>
                <div class="card-body">

                    <p><strong>Nama Pet: </strong> {{ $rekamMedis->pet->nama }}</p>
                    <p><strong>Jenis Hewan: </strong> {{ $rekamMedis->pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }}</p>
                    <p><strong>Ras: </strong> {{ $rekamMedis->pet->rasHewan->nama_ras ?? '-' }}</p>
                    <p><strong>Tanggal Lahir: </strong> {{ $rekamMedis->pet->tanggal_lahir }}</p>
                    <p><strong>Jenis Kelamin: </strong> {{ $rekamMedis->pet->jenis_kelamin }}</p>
                    <p><strong>Warna / Tanda: </strong> {{ $rekamMedis->pet->warna_tanda }}</p>

                </div>
            </div>
        </div>

        {{-- INFORMASI PEMERIKSAAN --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-secondary">
                    <h3 class="card-title text-white">Informasi Pemeriksaan</h3>
                </div>
                <div class="card-body">

                    <p><strong>No Urut: </strong> {{ $rekamMedis->temuDokter->no_urut }}</p>
                    <p><strong>Waktu Daftar: </strong> {{ $rekamMedis->temuDokter->waktu_daftar }}</p>
                    <p><strong>Dokter Pemeriksa: </strong> {{ $rekamMedis->roleUser->user->nama }}</p>
                    <p><strong>Pemilik: </strong> {{ $rekamMedis->pet->pemilik->user->nama }}</p>
                    <p><strong>Email: </strong> {{ $rekamMedis->pet->pemilik->user->email }}</p>
                    <p><strong>No WA: </strong> {{ $rekamMedis->pet->pemilik->no_wa }}</p>
                    <p><strong>Alamat: </strong> {{ $rekamMedis->pet->pemilik->alamat }}</p>

                </div>
            </div>
        </div>

    </div>


    {{-- TABEL HASIL PEMERIKSAAN --}}
    <div class="card">
        <div class="card-header bg-primary">
            <h3 class="card-title text-white">Hasil Pemeriksaan</h3>
        </div>

        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead class="bg-light text-center">
                    <tr>
                        <th>Anamnesa</th>
                        <th>Temuan Klinis</th>
                        <th>Diagnosa</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <tr>
                        <td>{{ $rekamMedis->anamnesa }}</td>
                        <td>{{ $rekamMedis->temuan_klinis }}</td>
                        <td>{{ $rekamMedis->diagnosa }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    {{-- TINDAKAN & TERAPI --}}
    <div class="card">
        <div class="card-header bg-info">
            <h3 class="card-title text-white">Tindakan & Terapi</h3>
        </div>

        <div class="card-body p-0">

            <table class="table table-bordered mb-0">
                <thead class="bg-light text-center">
                    <tr>
                        <th>#</th>
                        <th>Kode</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th>Kategori Klinis</th>
                        <th>Detail Tambahan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($detailRekamMedis as $detail)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $detail->kodeTindakanTerapi->kode }}</td>
                            <td>{{ $detail->kodeTindakanTerapi->deskripsi_tindakan_terapi }}</td>
                            <td>{{ $detail->kodeTindakanTerapi->kategori->nama_kategori }}</td>
                            <td>{{ $detail->kodeTindakanTerapi->kategoriKlinis->nama_kategori_klinis }}</td>
                            <td>{{ $detail->detail }}</td>
                            <td>
                                <form action="{{ route('admin.detail-rekam-medis.delete', $detail->iddetail_rekam_medis) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus tindakan ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada data.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>


    {{-- FORM TAMBAH TINDAKAN --}}
    <div class="card">
        <div class="card-header bg-success">
            <h3 class="card-title text-white">Tambah Tindakan / Terapi</h3>
        </div>

        <form action="{{ route('admin.detail-rekam-medis.store') }}" method="POST">
            @csrf
            <input type="hidden" name="idrekam_medis" value="{{ $rekamMedis->idrekam_medis }}">

            <div class="card-body">

                <div class="row">
                    {{-- SELECT TINDAKAN --}}
                    <div class="col-md-6">
                        <label>Kode Tindakan/Terapi</label>
                        <select name="kodeTindakan" class="form-control" required>
                            <option value="" disabled selected>-- Pilih --</option>
                            @foreach ($kodeTindakan as $data)
                                <option value="{{ $data->idkode_tindakan_terapi }}">
                                    {{ $data->kode }} — {{ $data->deskripsi_tindakan_terapi }}
                                    — {{ $data->kategori->nama_kategori }}
                                    — {{ $data->kategoriKlinis->nama_kategori_klinis }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- DETAIL --}}
                    <div class="col-md-4">
                        <label>Detail</label>
                        <input type="text" name="detail" class="form-control">
                    </div>

                    {{-- BUTTON --}}
                    <div class="col-md-2 d-flex align-items-end">
                        <button class="btn btn-primary w-100">
                            <i class="fas fa-plus"></i> Tambah
                        </button>
                    </div>
                </div>

            </div>

        </form>
    </div>


</div>
</div>

@endsection
