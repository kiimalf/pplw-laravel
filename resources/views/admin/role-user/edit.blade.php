<x-app-layout>
    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-6">
        <div class="p-6 text-lg font-semibold text-gray-900 dark:text-gray-100">
            Edit Role {{ $user->nama }}
        </div>
    </div>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-xl mb-6 border-gray-300 dark:border-gray-700 border">
        <div class="bg-gray-300 dark:bg-gray-700 text-white font-semibold px-4 py-4 rounded-t-lg">
            Daftar Role yang Dimiliki {{ $user->nama }}
        </div>
        <div class="rounded-lg p-3">
            <table class="table-fixed min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-700 border border-radius-xl">
                <thead class="bg-gray-300 dark:bg-gray-700 ">
                    <tr class="text-center">
                        <th class="px-6 py-4 text-xs font-bold uppercase w-10 tracking-wider">#</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Role</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase  w-64 tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($user->roleUser as $row)
                        <tr class="text-center">
                            <td class="px-6 py-3">{{ $loop->iteration }}</td>
                            <td class="px-6 py-3">{{ $row->role->nama_role }}</td>
                            <td class="px-6 py-3">{{ $row->status }}</td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2 justify-center">

                                    <form action="{{ route('admin.role-user.updateStatus', $row->idrole_user) }}" method="POST">
                                        @csrf
                                        <button class="bg-orange-500 text-white px-4 py-1 rounded-lg hover:bg-orange-600 transition">
                                            Ubah Status
                                        </button>
                                    </form>


                                    <form action="{{ route('admin.role-user.delete', $row->idrole_user) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus user ini?')">

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
                                Belum ada Role.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        

    {{-- HEADER --}}
    

    {{-- CARD TAMBAH ROLE --}}
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg border border-gray-300 dark:border-gray-700 mt-4">
        <div class="bg-gray-300 dark:bg-gray-700 text-white font-semibold px-4 py-4 ">
            Tambah Role
        </div>
        <div class="px-6 py-3 w=1/2">
            <form action="{{ route('admin.role-user.store', $user->iduser) }}" method="POST">
                @csrf
                    <input type="hidden" name="iduser" value="{{ $user->iduser }}">
                <div class="flex items-center gap-4">

                    {{-- LABEL + SELECT --}}
                    
                        <label class="text-gray-700 dark:text-gray-200">Role</label>
                        <select name="idrole"
                            class="flex-1 mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200"
                            required>
                            <option value="" selected disabled>-- Pilih Role --</option>
                            @foreach($role as $data)
                                <option value="{{ $data->idrole }}">{{ $data->nama_role }}</option>
                            @endforeach
                        </select>
                    

                    {{-- BUTTON --}}
                    <button
                        class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 h-[42px]">
                        Tambah
                    </button>
                </div>
            </form>
        </div>

        {{-- ERROR MESSAGE --}}
        @if ($errors->any())
            <div class="mt-3 px-4 py-2 bg-red-200 text-red-800 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        </div>
    </div>

</div>


    {{-- <div class="mb-4">
        <label class="block text-gray-700 dark:text-gray-200">Nama</label>
        <input type="text" name="nama_role" disabled placeholder="{{ $user->roleuser->nama_role }}" class="w-full mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 dark:text-gray-200">Nama</label>
        <input type="text" name="nama_role" value="{{ $roleuser->user->nama }}" disabled placeholder="{{ $role->nama_role }}" class="w-full mt-1 px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200">
    </div> --}}



    {{-- <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-xl">
        <form action="{{ route('admin.role-user.update', $role->idrole) }}" method="POST" class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">

            @csrf



            <div class="flex justify-between">
                <div>
                    @if ($errors->any())
                        <div class="px-4 py-2 bg-red-200 text-red-800 rounded">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="gap-2 sm:flex sm:items-center sm:ms-6">
                    <a href="{{ route('admin.role.index') }}"
                        class="px-4 py-2 bg-gray-600 text-white rounded-lg">Kembali</a>
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Update
                    </button>
                </div>
            </div>
            Tombol
            
        </form>
    </div> --}}
    </div>
</x-app-layout>