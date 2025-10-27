<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Role</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($role as $index => $item)
        <tr>
            <td>
                {{ $item->idrole }}
            </td>
            <td>
                {{ $item->nama_role}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>