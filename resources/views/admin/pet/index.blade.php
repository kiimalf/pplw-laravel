{{-- <x-app-layout>
    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-6">
        <div class="p-6 text-lg font-semibold text-gray-900 dark:text-gray-100">
            Data Pet
        </div>
    </div>
    <div class="mb-4 flex justify-end items-center gap-4">

        <a href="{{ route('admin.pet.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            + Tambah Pet
        </a>
    </div>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-xl">
        <table class="table-fixed min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-gray-900 dark:text-gray-100">

            <thead class="bg-gray-300 dark:bg-gray-700 ">
                <tr class="text-center">
                    <th class="px-6 py-4 text-xs font-bold uppercase w-10 tracking-wider">#</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Nama Pet</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Tanggal Lahir</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Warna Tanda</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Jenis Kelamin</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Pemilik</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Ras Hewan</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase w-10 tracking-wider">Aksi</th>
                </tr>
            </thead>

            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">

                @forelse ($pets as $index => $pet)
                    <tr class="text-center">

                        <td class="px-6 py-3">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3">{{ $pet->nama }}</td>
                        <td class="px-6 py-3">{{ $pet->tanggal_lahir }}</td>
                        <td class="px-6 py-3">{{ $pet->warna_tanda }}</td>
                        <td class="px-6 py-3">
                            @if ( $pet->jenis_kelamin == '0')
                                Jantan
                            @elseif ($pet->jenis_kelamin == '1')
                                Betina
                            @endif
                        </td>
                        <td class="px-6 py-3">{{ $pet->pemilik->user->nama }}</td>
                        <td class="px-6 py-3">{{ $pet->rasHewan->nama_ras }}</td>

                        <td class="px-6 py-3">
                            <div class="flex gap-2 justify-center">

                                <a href="{{ route('admin.pet.edit', $pet->idpet) }}"
                                    class="bg-orange-500 text-white px-4 py-1 rounded-lg hover:bg-orange-600 transition">
                                    Edit
                                </a>

                                <form action="{{ route('admin.pet.delete', $pet->idpet) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus role ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="bg-red-600 text-white px-4 py-1 rounded-lg hover:bg-red-700">
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            Belum ada data.
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>
    </div>
</x-app-layout> --}}

@extends('layouts.lte.main')

@section('content')

<!--begin::App Content Header-->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Pet</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                    <li class="breadcrumb-item active">Pet</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col text-end">
                <a href="{{ route('admin.pet.create') }}" class="btn btn-primary">
                    + Tambah Pet
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3 class="card-title">Tabel Data Pet</h3></div>

            <div class="card-body">
                <table class="table table-bordered table-hover table-sm align-middle">
                    <thead class="text-center">
                        <tr>
                            <th style="width: 32px">#</th>
                            <th>Nama Pet</th>
                            <th>Tanggal Lahir</th>
                            <th>Warna Tanda</th>
                            <th>Jenis Kelamin</th>
                            <th>Pemilik</th>
                            <th>Ras Hewan</th>
                            <th style="width: 120px">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($pets as $pet)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pet->nama }}</td>
                            <td>{{ $pet->tanggal_lahir }}</td>
                            <td>{{ $pet->warna_tanda }}</td>
                            <td>{{ $pet->jenis_kelamin == '0' ? 'Jantan' : 'Betina' }}</td>
                            <td>{{ $pet->nama_pemilik }}</td>
                            <td>{{ $pet->nama_ras }}</td>

                            <td>
                                <a href="{{ route('admin.pet.edit', $pet->idpet) }}"
                                    class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('admin.pet.delete', $pet->idpet) }}"
                                      method="POST"
                                      style="display:inline-block;"
                                      onsubmit="return confirm('Yakin ingin menghapus Pet ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Belum ada data.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>

@endsection
