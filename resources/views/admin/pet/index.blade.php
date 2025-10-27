<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Pet</th>
            <th>Tanggal Lahir</th>
            <th>Warna Tanda</th>
            <th>Jenis Kelamin</th>
            <th>Nama Pemilik</th>
            <th>Nama Ras</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pet as $index => $item)
        <tr>
            <td>
                {{ $item->idpet }}
            </td>
            <td>
                {{ $item->nama }}
            </td>
            <td>
                {{ $item->tanggal_lahir }}
            </td>
            <td>
                {{ $item->warna_tanda }}
            </td>
            <td>
                {{ $item->jenis_kelamin }}
            </td>
            <td>
                {{ $item->pemilik->user->nama }}
            </td>
            <td>
                {{ $item->rasHewan->nama_ras }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>