<table>
    <thead>
        <tr>
            <th>MSISDN</th>
            <th>Nomor Polisi</th>
            <th>Tanggal Akhir PKB</th>
            <th>NJKB</th>
        </tr>
    </thead>
    <tbody>
        @foreach($excelFix as $excel)
        <tr>
            <td>{{ $excel->no_hp }}</td>
            <td>{{ $excel->no_polisi }}</td>
            <td>{{ $excel->tgl_akhir_pkb }}</td>
            <td>{{ $excel->njkb }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
