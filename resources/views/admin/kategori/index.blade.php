<table>
    <thead>
        <tr>
            <td>ID</td>
            <td>Kategori</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($kategori as $index => $items)
            <tr>
                <td>{{ $items->idkategori }}</td>
                <td>{{ $items->nama_kategori }}</td>
            </tr>
        @endforeach
    </tbody>
</table>