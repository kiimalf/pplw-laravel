<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Ras</th>
            <th>Jenis Hewan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rasHewan as $index => $item)
        <tr>
            <td>
                {{ $item->idras_hewan }}
            </td>
            <td>
                {{ $item->nama_ras}}
            </td>
            <td>
                {{ $item->jenisHewan->nama_jenis_hewan}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>