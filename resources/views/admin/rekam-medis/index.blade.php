<table>
    <thead>
        <tr>
            <td>ID</td>
            <td>Dibuat Pada</td>
            <td>Anamnesa</td>
            <td>Temuan Klinis</td>
            <td>Diagnosa</td>
            <td>Pet</td>
            <td>Dokter Pemeriksa</td>
        </tr>
    </thead>
    <tbody>
        @foreach ( $rekamMedis as $index => $items)
            <tr>
                <td>{{ $items->idrekam_medis }}</td>
                <td>{{ $items->created_at }}</td>
                <td>{{ $items->anamnesa }}</td>
                <td>{{ $items->temuan_klinis }}</td>
                <td>{{ $items->diagnosa }}</td>
                <td>
                    {{ $items->idpet}} - {{ $items->pet->nama }}
                </td>
                <td>{{ $items->user->nama }}</td>
            </tr>
        @endforeach
    </tbody>
</table>