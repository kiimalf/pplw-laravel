<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Password</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user as $index => $item)
        <tr>
            <td>
                {{ $item->iduser }}
            </td>
            <td>
                {{ $item->nama}}
            </td>
            <td>
                {{ $item->email}}
            </td>
            <td>
                {{ $item->password}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>