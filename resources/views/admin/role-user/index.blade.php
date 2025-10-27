<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID User</th>
            <th>Nama</th>
            <th>Role</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($roleuser as $user)
        <tr>
            <td>{{ $user->iduser }}</td>
            <td>{{ $user->nama }}</td>
            <td>
                @if ($user->roles->isEmpty())
                    -
                @else
                    @foreach ($user->roles as $role)
                        {{ $role->nama_role }} <br>
                    @endforeach
                @endif
            </td>
            <td>
                @foreach ($user->roles as $role)
                    {{ $role->pivot->status }} <br>
                @endforeach
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
