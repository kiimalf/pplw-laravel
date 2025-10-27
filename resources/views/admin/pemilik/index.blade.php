<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>No WA</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pemilik as $index => $item)
        <tr>
            <td>
                {{ $item->idpemilik }}
            </td>
            <td>
                {{ $item->user->nama }}
            </td>
            <td>
                {{ $item->no_wa }}
            </td>
            <td>
                {{ $item->alamat }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>