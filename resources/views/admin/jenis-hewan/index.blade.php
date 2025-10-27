<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Jenis Hewan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($jenisHewan as $index => $item)
        <tr>
            <td>
                {{ $item->idjenis_hewan }}
            </td>
            <td>
                {{ $item->nama_jenis_hewan }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>