<table>
    <thead>
        <tr>
            <td>ID</td>
            <td>kode</td>
            <td>Deskripsi</td>
            <td>Kategori</td>
            <td>Kategori Klinis</td>
        </tr>
    </thead>
    <tbody>
        @foreach ( $kodeTindakanTerapi as $index => $items )
            <tr>
                <td>{{ $items->idkode_tindakan_terapi }}</td>
                <td>{{ $items->kode }}</td>
                <td>{{ $items->deskripsi_tindakan_terapi }}</td>
                <td>{{ $items->kategori->nama_kategori }}</td>
                <td>{{ $items->kategoriKlinis->nama_kategori_klinis }}</td>
            </tr>
        @endforeach
    </tbody>
</table>