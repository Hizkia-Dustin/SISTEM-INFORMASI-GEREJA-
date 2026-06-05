<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 28px; }
        body { font-family: DejaVu Sans, Arial, sans-serif; color: #111827; font-size: 10px; }
        h1 { margin: 0; color: #0f3a75; font-size: 20px; text-align: center; }
        .meta { text-align: center; color: #4b5563; margin-top: 4px; }
        .summary { width: 100%; margin: 20px 0 16px; border-collapse: collapse; }
        .summary td { border: 1px solid #d1d5db; padding: 10px; }
        .summary .label { background: #e5eefc; color: #0f3a75; font-weight: bold; text-transform: uppercase; font-size: 9px; }
        .summary .value { font-size: 14px; font-weight: bold; text-align: right; }
        table.report { width: 100%; border-collapse: collapse; }
        table.report th, table.report td { border: 1px solid #d1d5db; padding: 6px; vertical-align: top; }
        table.report th { background: #0f3a75; color: white; font-size: 9px; text-transform: uppercase; }
        .section { margin-top: 16px; padding: 7px; background: #e5eefc; color: #0f3a75; font-weight: bold; text-transform: uppercase; }
        .right { text-align: right; }
        .center { text-align: center; }
        .total td { background: #f3f4f6; font-weight: bold; }
        .debit { color: #047857; }
        .kredit { color: #be123c; }
    </style>
</head>
<body>
    <h1>LAPORAN KEUANGAN GKI PAKUWON</h1>
    <div class="meta">Periode {{ \Carbon\Carbon::parse($periodeAwal)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($periodeAkhir)->format('d M Y') }}</div>
    <div class="meta">Kategori: {{ $kategori ?: 'Semua Kategori' }}</div>

    <table class="summary">
        <tr>
            <td class="label">Total Debit / Pemasukan</td>
            <td class="label">Total Kredit / Pengeluaran</td>
            <td class="label">Saldo Akhir</td>
        </tr>
        <tr>
            <td class="value debit">Rp {{ number_format($laporan['total_debit'], 0, ',', '.') }}</td>
            <td class="value kredit">Rp {{ number_format($laporan['total_kredit'], 0, ',', '.') }}</td>
            <td class="value">Rp {{ number_format($laporan['saldo_akhir'], 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="section">Buku Kas Umum</div>
    <table class="report">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>No. Bukti</th>
                <th>Uraian</th>
                <th>Kategori</th>
                <th>Akun Debit</th>
                <th>Akun Kredit</th>
                <th>Debit</th>
                <th>Kredit</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporan['rows'] as $row)
                <tr>
                    <td class="center">{{ \Carbon\Carbon::parse($row['tanggal'])->format('d/m/Y') }}</td>
                    <td class="center">{{ $row['nomor_bukti'] }}</td>
                    <td>{{ $row['uraian'] }}</td>
                    <td>{{ $row['kategori'] }}</td>
                    <td>{{ $row['akun_debit'] }}</td>
                    <td>{{ $row['akun_kredit'] }}</td>
                    <td class="right">{{ $row['debit'] > 0 ? number_format($row['debit'], 0, ',', '.') : '-' }}</td>
                    <td class="right">{{ $row['kredit'] > 0 ? number_format($row['kredit'], 0, ',', '.') : '-' }}</td>
                    <td class="right">{{ number_format($row['saldo'], 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr><td colspan="9" class="center">Belum ada transaksi pada periode ini.</td></tr>
            @endforelse
            <tr class="total">
                <td colspan="6" class="right">Total</td>
                <td class="right">{{ number_format($laporan['total_debit'], 0, ',', '.') }}</td>
                <td class="right">{{ number_format($laporan['total_kredit'], 0, ',', '.') }}</td>
                <td class="right">{{ number_format($laporan['saldo_akhir'], 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="section">Rekap Kategori</div>
    <table class="report">
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Pemasukan</th>
                <th>Pengeluaran</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporan['rekap_kategori'] as $rekap)
                <tr>
                    <td>{{ $rekap['kategori'] }}</td>
                    <td class="right">{{ number_format($rekap['pemasukan'], 0, ',', '.') }}</td>
                    <td class="right">{{ number_format($rekap['pengeluaran'], 0, ',', '.') }}</td>
                    <td class="right">{{ number_format($rekap['saldo'], 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="center">Belum ada rekap kategori.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
