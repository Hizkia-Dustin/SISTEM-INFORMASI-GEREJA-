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
                <th>NIK / No Induk</th>
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>Jenis Kelamin</th>
                <th>Posisi Keluarga</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Status Nikah</th>
                <th>Status Keanggotaan</th>
                <th>No Telepon</th>
                <th>Alamat</th>
                <th>Sudah Baptis</th>
                <th>Sudah Sidi</th>
                <th>No KK</th>
                <th>Nama Kepala Keluarga</th>
                <th>Sektor Pelayanan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jemaatList as $index => $j)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>'{{ $j->no_induk }}</td>
                <td>{{ $j->nama_lengkap }}</td>
                <td>{{ $j->username ?: '-' }}</td>
                <td>{{ $j->jenis_kelamin }}</td>
                <td>{{ $j->posisi }}</td>
                <td>{{ $j->tempat_lahir }}</td>
                <td>{{ $j->tanggal_lahir ? \Carbon\Carbon::parse($j->tanggal_lahir)->format('d/m/Y') : '-' }}</td>
                <td>{{ $j->status_nikah }}</td>
                <td>{{ $j->status_keanggotaan }}</td>
                <td>'{{ $j->no_telepon }}</td>
                <td>{{ $j->alamat }}</td>
                <td>{{ $j->baptis ?: 'Tidak' }}</td>
                <td>{{ $j->sidi ?: 'Tidak' }}</td>
                <td>'{{ $j->keluarga ? $j->keluarga->no_kk : '-' }}</td>
                <td>{{ $j->keluarga ? $j->keluarga->nama_kepala_keluarga : '-' }}</td>
                <td>{{ $j->keluarga ? $j->keluarga->wilayah_pelayanan : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
