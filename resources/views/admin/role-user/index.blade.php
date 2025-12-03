<x-app-layout>
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
</x-app-layout>