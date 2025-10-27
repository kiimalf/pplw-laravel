<table>
    <thead>
        <tr>
            <td>ID</td>
            <td>ID Rekam Medis</td>
            <td>Kode Tindakan Terapi</td>
            <td>detail</td>
        </tr>
    </thead>
    <tbody>
        @foreach ( $detailRekamMedis as $rekamMedis )
            <tr>
                <td>{{ $rekamMedis->idrekam_medis }}</td>
                <td>
                    {{ $rekamMedis->kodeTindakanTerapi->kode }}
                </td>
                <td>{{ $rekamMedis->pivot->detail }}</td>
            </tr>
        @endforeach
    </tbody>
{{-- </table> --}}