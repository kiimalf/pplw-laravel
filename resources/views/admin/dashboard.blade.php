@extends('layouts.lte.main')

@section('content')

{{-- HEADER --}}
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Dashboard</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

{{-- CONTENT --}}
<div class="app-content">
    <div class="container-fluid">

        {{-- STAT CARDS --}}
        <div class="row">

            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $totalPets }}</h3>
                        <p>Total Pet Terdaftar</p>
                    </div>
                    <div class="icon"><i class="fas fa-paw"></i></div>
                    <a href="{{ route('admin.pet.index') }}" class="small-box-footer">
                        Lihat Data <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalOwners }}</h3>
                        <p>Total Pemilik</p>
                    </div>
                    <div class="icon"><i class="fas fa-user"></i></div>
                    <a href="{{ route('admin.pemilik.index') }}" class="small-box-footer">
                        Lihat Data <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $totalDoctors }}</h3>
                        <p>Dokter Aktif</p>
                    </div>
                    <div class="icon"><i class="fas fa-user-md"></i></div>
                    <a href="{{ route('admin.user.index') }}" class="small-box-footer">
                        Lihat Data <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $waitingReservasi }}</h3>
                        <p>Reservasi Menunggu</p>
                    </div>
                    <div class="icon"><i class="fas fa-clock"></i></div>
                    <a href="{{ route('admin.temu-dokter.index') }}" class="small-box-footer">
                        Lihat Reservasi <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

        </div>

        {{-- ROW 2 --}}
        <div class="row">

            {{-- RESERVASI TERBARU --}}
            <div class="col-lg-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Reservasi Terbaru</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>No Urut</th>
                                    <th>Nama Pet</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentReservasi as $item)
                                    <tr>
                                        <td>{{ $item->no_urut }}</td>
                                        <td>{{ $item->nama_pet }}</td>
                                        <td>
                                            @if ($item->status == 0)
                                                <span class="badge bg-warning">Menunggu</span>
                                            @else
                                                <span class="badge bg-success">Selesai</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">Belum ada reservasi.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- REKAM MEDIS TERBARU --}}
            <div class="col-lg-6">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Rekam Medis Terbaru</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>ID Rekam Medis</th>
                                    <th>Nama Pet</th>
                                    <th>Dokter Pemeriksa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentRekamMedis as $rm)
                                    <tr>
                                        <td>{{ $rm->idrekam_medis }}</td>
                                        <td>{{ $rm->nama_pet }}</td>
                                        <td>{{ $rm->dokter }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">Belum ada rekam medis.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection
