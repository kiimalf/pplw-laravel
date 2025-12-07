{{-- <x-app-layout>
    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-6">
        <div class="p-6 text-lg font-semibold text-gray-900 dark:text-gray-100">
            Data Role User
        </div>
    </div>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-xl">
        <table class="table-fixed min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-gray-900 dark:text-gray-100">

            <thead class="bg-gray-300 dark:bg-gray-700 ">
                <tr class="text-center">
                    <th class="px-6 py-4 text-xs font-bold uppercase w-10 tracking-wider">#</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">User</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Email</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Role</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase w-10 tracking-wider">Aksi</th>
                </tr>
            </thead>

            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">

                @forelse ($users as $user)
                    <tr class="text-center">
                        <td class="px-6 py-3">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3">{{ $user->nama }}</td>
                        <td class="px-6 py-3">{{ $user->email }}</td>
                        <td class="px-6 py-3">
                            @if ($user->roleUser->isEmpty())
                                <span class="text-gray-500">Tidak punya role</span>
                            @else
                                @foreach ($user->roleUser as $ru)
                                    <div>{{ $ru->role->nama_role }}</div>
                                @endforeach
                            @endif
                        </td>
                        <td class="px-6 py-3">
                            @if ($user->roleUser->isEmpty())
                                <span class="text-gray-500">-</span>
                            @else
                                @foreach ($user->roleUser as $ru)
                                    <div>{{ $ru->status }}</div>
                                @endforeach
                            @endif
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex gap-2 justify-center">

                                <a href="{{ route('admin.role-user.edit', $user->iduser) }}"
                                    class="bg-orange-500 text-white px-4 py-1 rounded-lg hover:bg-orange-600 transition">
                                    Edit
                                </a>

                                <form action="{{ route('admin.role-user.delete', $user->iduser) }}"
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
        <!--begin::Container-->
        <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">Role User</h3></div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                <li class="breadcrumb-item active" aria-current="page">Role User</li>
            </ol>
            </div>
        </div>
        <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header"><h3 class="card-title">Tabel Data Role User</h3></div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th style="width: 32px">#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th style="width: 120px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->nama }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if ($user->roleUser->isEmpty())
                                                    <span>Tidak punya role</span>
                                                @else
                                                    @foreach ($user->roleUser as $ru)
                                                        <div>{{ $ru->role->nama_role }}</div>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                @if ($user->roleUser->isEmpty())
                                                    <span class="badge bg-secondary">-</span>
                                                @else
                                                    @foreach ($user->roleUser as $ru)
                                                        
                                                        @if ($ru->status == 1)
                                                            <span class="badge bg-success">Aktif</span>
                                                        @else
                                                            <span class="badge bg-danger">Tidak Aktif</span>
                                                        @endif
                                                        
                                                        <br>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.role-user.edit', $user->iduser) }}"
                                                    class="btn btn-warning btn-sm">
                                                    Edit
                                                </a>
                                                
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
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-end">
                            <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection