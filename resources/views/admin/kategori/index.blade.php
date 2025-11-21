<x-app-layout>
    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-6">
        <div class="p-6 text-lg font-semibold text-gray-900 dark:text-gray-100">
            Data Kategori
        </div>
    </div>
    <div class="mb-4 flex justify-end items-center gap-4">

        <a href="{{ route('admin.kategori.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            + Tambah Kategori
        </a>
    </div>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-xl">
        <table class="table-fixed min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-gray-900 dark:text-gray-100">

            <thead class="bg-gray-300 dark:bg-gray-700 ">
                <tr class="text-center">
                    <th class="px-6 py-4 text-xs font-bold uppercase w-10 tracking-wider">#</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Nama Kategori</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase w-10 tracking-wider">Aksi</th>
                </tr>
            </thead>

            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">

                @forelse ($kategoris as $index => $kategori)
                    <tr class="text-center">

                        <td class="px-6 py-3">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3">{{ $kategori->nama_kategori }}</td>

                        <td class="px-6 py-3">
                            <div class="flex gap-2 justify-center">

                                <a href="{{ route('admin.kategori.edit', $kategori->idkategori) }}"
                                    class="bg-orange-500 text-white px-4 py-1 rounded-lg hover:bg-orange-600 transition">
                                    Edit
                                </a>

                                <form action="{{ route('admin.kategori.delete',$kategori->idkategori) }}"
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