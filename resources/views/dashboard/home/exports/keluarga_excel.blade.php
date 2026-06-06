<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
    <table border="1">
        <thead>
            <tr style="background-color: #00236f; color: #ffffff; font-weight: bold;">
                <th>No</th>
                <th>No KK</th>
                <th>Nama Kepala Keluarga</th>
                <th>Alamat Keluarga</th>
                <th>Sektor / Wilayah Pelayanan</th>
                <th>Tanggal Registrasi / Nikah</th>
                <th>Status Keluarga</th>
                <th>Jumlah Anggota Keluarga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($keluargaList as $index => $k)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>'{{ $k->no_kk }}</td>
                <td>{{ $k->nama_kepala_keluarga }}</td>
                <td>{{ $k->alamat_keluarga }}</td>
                <td>{{ $k->wilayah_pelayanan }}</td>
                <td>{{ $k->tanggal_registrasi ? \Carbon\Carbon::parse($k->tanggal_registrasi)->format('d/m/Y') : '-' }}</td>
                <td>{{ $k->status ?: 'Aktif' }}</td>
                <td>{{ $k->jemaat ? $k->jemaat->count() : 0 }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
