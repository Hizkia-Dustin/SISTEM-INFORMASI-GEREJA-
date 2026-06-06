<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Statistik Jemaat</title>
    <style>
        @page { margin: 35px; }
        body { font-family: DejaVu Sans, Arial, sans-serif; color: #1e293b; font-size: 10px; line-height: 1.5; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #00236f; padding-bottom: 15px; }
        .header h1 { margin: 0; color: #00236f; font-size: 18px; text-transform: uppercase; letter-spacing: 0.5px; }
        .header p { margin: 4px 0 0; color: #64748b; font-size: 10px; }
        .date { text-align: right; color: #64748b; font-size: 8px; margin-bottom: 15px; }
        
        .section-title { background: #f1f5f9; color: #00236f; padding: 6px 10px; font-weight: bold; font-size: 11px; text-transform: uppercase; margin-top: 20px; margin-bottom: 10px; border-left: 3px solid #00236f; }
        
        /* Stats Grid */
        .stats-grid { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        .stats-grid td { border: 1px solid #e2e8f0; padding: 10px; width: 25%; text-align: center; }
        .stats-label { color: #64748b; font-size: 8px; text-transform: uppercase; font-weight: bold; margin-bottom: 4px; }
        .stats-value { font-size: 16px; font-weight: bold; color: #0f172a; }
        
        /* Two Column Stats */
        .columns { width: 100%; margin-top: 10px; }
        .columns td { width: 50%; vertical-align: top; padding: 0 10px; }
        
        /* Tables */
        table.data-table { width: 100%; border-collapse: collapse; margin-top: 5px; }
        table.data-table th, table.data-table td { border: 1px solid #e2e8f0; padding: 6px 8px; text-align: left; }
        table.data-table th { background: #00236f; color: white; font-size: 8px; text-transform: uppercase; font-weight: bold; }
        table.data-table tr:nth-child(even) { background: #f8fafc; }
        .center { text-align: center; }
        .right { text-align: right; }
        
        .page-break { page-break-before: always; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Gereja Kristen Indonesia Pakuwon</h1>
        <p>Laporan Statistik Keanggotaan & Demografi Jemaat</p>
    </div>
    
    <div class="date">Dicetak pada: {{ now()->translatedFormat('d F Y H:i') }}</div>
    
    <div class="section-title">Ringkasan Statistik Utama</div>
    <table class="stats-grid">
        <tr>
            <td>
                <div class="stats-label">Total Jemaat</div>
                <div class="stats-value">{{ $stats['jemaat'] }}</div>
            </td>
            <td>
                <div class="stats-label">Total Keluarga</div>
                <div class="stats-value">{{ $stats['keluarga'] }}</div>
            </td>
            <td>
                <div class="stats-label">Jemaat Aktif</div>
                <div class="stats-value" style="color: #16a34a;">{{ $stats['aktif'] }}</div>
            </td>
            <td>
                <div class="stats-label">Pemuda/Pemudi</div>
                <div class="stats-value">{{ $stats['pemuda'] }}</div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="stats-label">Laki-Laki (AMA)</div>
                <div class="stats-value">{{ $stats['ama'] }}</div>
            </td>
            <td>
                <div class="stats-label">Perempuan (INA)</div>
                <div class="stats-value">{{ $stats['ina'] }}</div>
            </td>
            <td>
                <div class="stats-label">Jemaat Baptis</div>
                <div class="stats-value">{{ $stats['baptis'] }}</div>
            </td>
            <td>
                <div class="stats-label">Jemaat Sidi</div>
                <div class="stats-value">{{ $stats['sidi'] }}</div>
            </td>
        </tr>
    </table>

    <table class="columns">
        <tr>
            <td style="padding-left: 0;">
                <div class="section-title" style="margin-top: 0;">Demografi Kategori Usia</div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Kategori Usia</th>
                            <th class="center">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ageStats as $category => $count)
                        <tr>
                            <td>{{ $category }}</td>
                            <td class="center font-bold">{{ $count }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </td>
            <td style="padding-right: 0;">
                <div class="section-title" style="margin-top: 0;">Persebaran Sektor Pelayanan</div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Wilayah/Sektor</th>
                            <th class="center">Keluarga</th>
                            <th class="center">Jemaat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sektorStats as $sektor)
                        <tr>
                            <td>{{ $sektor['nama'] }}</td>
                            <td class="center">{{ $sektor['keluarga_count'] }}</td>
                            <td class="center font-bold">{{ $sektor['jemaat_count'] }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="center">Belum ada data sektor</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

    <div class="page-break"></div>

    <div class="section-title">Daftar Anggota Jemaat Terdaftar</div>
    <table class="data-table" style="font-size: 8px;">
        <thead>
            <tr>
                <th style="width: 3%;">No</th>
                <th style="width: 12%;">No Induk (NIK)</th>
                <th style="width: 25%;">Nama Lengkap</th>
                <th style="width: 10%;">L/P</th>
                <th style="width: 15%;">Tanggal Lahir</th>
                <th style="width: 15%;">Sektor/Keluarga</th>
                <th style="width: 10%;" class="center">Baptis</th>
                <th style="width: 10%;" class="center">Sidi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jemaatList as $index => $jemaat)
            <tr>
                <td class="center">{{ $index + 1 }}</td>
                <td>{{ $jemaat->no_induk ?: '-' }}</td>
                <td style="font-weight: bold;">{{ $jemaat->nama_lengkap }}</td>
                <td>{{ in_array($jemaat->jenis_kelamin, ['Laki-laki', 'L', 'Laki-Laki']) ? 'Laki-laki' : 'Perempuan' }}</td>
                <td>{{ $jemaat->tanggal_lahir ? \Carbon\Carbon::parse($jemaat->tanggal_lahir)->format('d/m/Y') : '-' }}</td>
                <td>
                    @if($jemaat->keluarga)
                        {{ $jemaat->keluarga->wilayah_pelayanan ?: 'Tanpa Sektor' }}
                    @else
                        -
                    @endif
                </td>
                <td class="center">{{ $jemaat->baptis ?: 'Tidak' }}</td>
                <td class="center">{{ $jemaat->sidi ?: 'Tidak' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="center">Belum ada data jemaat terdaftar.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
