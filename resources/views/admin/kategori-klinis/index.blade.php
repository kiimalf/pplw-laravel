<table>
    <thead>
        <tr>
            <td>ID</td>
            <td>Kategori</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($kategoriKlinis as $index => $items)
            <tr>
                <td>{{ $items->idkategori_klinis }}</td>
                <td>{{ $items->nama_kategori_klinis }}</td>
            </tr>
        @endforeach
    </tbody>
</table>