<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; color: #111827; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #d1d5db; padding: 8px; font-size: 12px; }
        th { background: #0f3a75; color: #ffffff; font-weight: bold; text-align: center; }
        .title { font-size: 20px; font-weight: bold; text-align: center; color: #0f3a75; }
        .subtitle { font-size: 12px; text-align: center; color: #4b5563; }
        .section { background: #e5eefc; color: #0f3a75; font-weight: bold; }
        .right { text-align: right; }
        .center { text-align: center; }
        .money { mso-number-format: "#,##0"; text-align: right; }
        .total { background: #f3f4f6; font-weight: bold; }
        .debit { color: #047857; }
        .kredit { color: #be123c; }
    </style>
</head>
<body>
    <table>
        <tr><td colspan="9" class="title">LAPORAN KEUANGAN GKI PAKUWON</td></tr>
        <tr><td colspan="9" class="subtitle">Periode {{ \Carbon\Carbon::parse($periodeAwal)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($periodeAkhir)->format('d M Y') }}</td></tr>
        <tr><td colspan="9" class="subtitle">Kategori: {{ $kategori ?: 'Semua Kategori' }}</td></tr>
        <tr><td colspan="9">&nbsp;</td></tr>
        <tr>
            <td colspan="2" class="section">Saldo Awal</td>
            <td colspan="2" class="section">Kas Masuk</td>
            <td colspan="2" class="section">Kas Keluar</td>
            <td colspan="2" class="section">Mutasi Bersih</td>
            <td class="section">Saldo Akhir</td>
        </tr>
        <tr>
            <td colspan="2" class="money">{{ $laporan['saldo_awal'] }}</td>
            <td colspan="2" class="money debit">{{ $laporan['total_pemasukan'] }}</td>
            <td colspan="2" class="money kredit">{{ $laporan['total_pengeluaran'] }}</td>
            <td colspan="2" class="money">{{ $laporan['mutasi_bersih'] }}</td>
            <td class="money">{{ $laporan['saldo_akhir'] }}</td>
        </tr>
        <tr><td colspan="9">&nbsp;</td></tr>
        <tr><td colspan="9" class="section">Buku Kas Umum</td></tr>
        <tr>
            <th>Tanggal</th>
            <th>No. Bukti</th>
            <th>Uraian</th>
            <th>Kategori</th>
            <th>Akun Debit</th>
            <th>Akun Kredit</th>
            <th>Kas Masuk</th>
            <th>Kas Keluar</th>
            <th>Saldo</th>
        </tr>
        <tr class="total">
            <td colspan="8" class="right">Saldo awal sebelum periode</td>
            <td class="money">{{ $laporan['saldo_awal'] }}</td>
        </tr>
        @forelse($laporan['rows'] as $row)
            <tr>
                <td class="center">{{ \Carbon\Carbon::parse($row['tanggal'])->format('d/m/Y') }}</td>
                <td class="center">{{ $row['nomor_bukti'] }}</td>
                <td>{{ $row['uraian'] }}</td>
                <td>{{ $row['kategori'] }}</td>
                <td>{{ $row['akun_debit'] }}</td>
                <td>{{ $row['akun_kredit'] }}</td>
                <td class="money">{{ $row['debit'] ?: '' }}</td>
                <td class="money">{{ $row['kredit'] ?: '' }}</td>
                <td class="money">{{ $row['saldo'] }}</td>
            </tr>
        @empty
            <tr><td colspan="9" class="center">Belum ada transaksi pada periode ini.</td></tr>
        @endforelse
        <tr class="total">
            <td colspan="6" class="right">Total</td>
            <td class="money">{{ $laporan['total_pemasukan'] }}</td>
            <td class="money">{{ $laporan['total_pengeluaran'] }}</td>
            <td class="money">{{ $laporan['saldo_akhir'] }}</td>
        </tr>
        <tr><td colspan="9">&nbsp;</td></tr>
        <tr><td colspan="9" class="section">Jurnal Umum</td></tr>
        <tr>
            <th>Tanggal</th>
            <th>No. Bukti</th>
            <th colspan="2">Akun</th>
            <th colspan="2">Keterangan</th>
            <th>Debit</th>
            <th>Kredit</th>
            <th>Status</th>
        </tr>
        @forelse($laporan['rows'] as $row)
            <tr>
                <td rowspan="2" class="center">{{ \Carbon\Carbon::parse($row['tanggal'])->format('d/m/Y') }}</td>
                <td rowspan="2" class="center">{{ $row['nomor_bukti'] }}</td>
                <td colspan="2">{{ $row['akun_debit'] }}</td>
                <td colspan="2" rowspan="2">{{ $row['uraian'] }}</td>
                <td class="money">{{ $row['jurnal_debit'] }}</td>
                <td class="money"></td>
                <td rowspan="2" class="center">Seimbang</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;&nbsp;&nbsp;{{ $row['akun_kredit'] }}</td>
                <td class="money"></td>
                <td class="money">{{ $row['jurnal_kredit'] }}</td>
            </tr>
        @empty
            <tr><td colspan="9" class="center">Belum ada jurnal pada periode ini.</td></tr>
        @endforelse
        <tr class="total">
            <td colspan="6" class="right">Total Jurnal</td>
            <td class="money">{{ $laporan['total_jurnal_debit'] }}</td>
            <td class="money">{{ $laporan['total_jurnal_kredit'] }}</td>
            <td class="center">{{ $laporan['total_jurnal_debit'] == $laporan['total_jurnal_kredit'] ? 'Seimbang' : 'Tidak Seimbang' }}</td>
        </tr>
        <tr><td colspan="9">&nbsp;</td></tr>
        <tr><td colspan="9" class="section">Neraca Saldo</td></tr>
        <tr>
            <th colspan="4">Akun</th>
            <th colspan="2">Debit</th>
            <th colspan="2">Kredit</th>
            <th>Saldo Normal</th>
        </tr>
        @forelse($laporan['ringkasan_akun'] as $akun)
            <tr>
                <td colspan="4">{{ $akun['akun'] }}</td>
                <td colspan="2" class="money">{{ $akun['debit'] ?: '' }}</td>
                <td colspan="2" class="money">{{ $akun['kredit'] ?: '' }}</td>
                <td class="center">{{ $akun['posisi'] }}</td>
            </tr>
        @empty
            <tr><td colspan="9" class="center">Belum ada akun jurnal.</td></tr>
        @endforelse
        <tr class="total">
            <td colspan="4" class="right">Total Jurnal</td>
            <td colspan="2" class="money">{{ $laporan['total_jurnal_debit'] }}</td>
            <td colspan="2" class="money">{{ $laporan['total_jurnal_kredit'] }}</td>
            <td class="center">{{ $laporan['total_jurnal_debit'] == $laporan['total_jurnal_kredit'] ? 'Seimbang' : 'Tidak Seimbang' }}</td>
        </tr>
        <tr><td colspan="9">&nbsp;</td></tr>
        <tr><td colspan="9" class="section">Rekap Kategori</td></tr>
        <tr>
            <th colspan="3">Kategori</th>
            <th colspan="2">Pemasukan</th>
            <th colspan="2">Pengeluaran</th>
            <th colspan="2">Saldo</th>
        </tr>
        @forelse($laporan['rekap_kategori'] as $rekap)
            <tr>
                <td colspan="3">{{ $rekap['kategori'] }}</td>
                <td colspan="2" class="money">{{ $rekap['pemasukan'] }}</td>
                <td colspan="2" class="money">{{ $rekap['pengeluaran'] }}</td>
                <td colspan="2" class="money">{{ $rekap['saldo'] }}</td>
            </tr>
        @empty
            <tr><td colspan="9" class="center">Belum ada rekap kategori.</td></tr>
        @endforelse
    </table>
</body>
</html>
