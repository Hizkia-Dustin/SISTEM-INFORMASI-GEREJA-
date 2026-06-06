@extends('dashboard.layouts.app')
@section('title', 'Laporan Keuangan')

@section('content')
<style>
@media print {
    aside, header, nav, footer, form, button, .no-print {
        display: none !important;
    }
    .print-stack {
        display: block !important;
    }
    body {
        background: white !important;
        color: black !important;
        padding: 0 !important;
        margin: 0 !important;
    }
    .print-full {
        width: 100% !important;
        max-width: 100% !important;
        box-shadow: none !important;
        border: none !important;
        padding: 0 !important;
        margin: 0 !important;
        display: block !important;
    }
    .overflow-x-auto {
        overflow: visible !important;
    }
    table {
        width: 100% !important;
        border-collapse: collapse !important;
    }
    th, td {
        padding: 6px 4px !important;
        font-size: 11px !important;
        border-bottom: 1px solid #e2e8f0 !important;
    }
}
</style>
<x-dashboard.page-header title="Laporan Keuangan" subtitle="Buku kas, rekap kategori, dan unduhan laporan akuntansi.">
    <a href="{{ route('dashboard.keuangan.index') }}" class="px-5 py-2.5 bg-white border border-gray-100 text-gray-600 rounded-xl text-sm font-bold hover:bg-gray-50 transition-all">
        Kembali
    </a>
</x-dashboard.page-header>

<form method="GET" action="{{ route('dashboard.keuangan.laporan') }}" class="no-print bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-8">
    <div class="grid grid-cols-4 gap-4 items-end">
        <div>
            <label class="block mb-2 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Periode Awal</label>
            <input type="date" name="periode_awal" value="{{ $periodeAwal }}" onchange="this.form.submit()" class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm font-bold text-gray-700 focus:ring-2 focus:ring-primary/10">
        </div>
        <div>
            <label class="block mb-2 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Periode Akhir</label>
            <input type="date" name="periode_akhir" value="{{ $periodeAkhir }}" onchange="this.form.submit()" class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm font-bold text-gray-700 focus:ring-2 focus:ring-primary/10">
        </div>
        <div>
            <label class="block mb-2 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Kategori</label>
            <select name="kategori" onchange="this.form.submit()" class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-sm font-bold text-gray-700 focus:ring-2 focus:ring-primary/10">
                <option value="">Semua Kategori</option>
                @foreach($kategoriList as $item)
                    <option value="{{ $item }}" @selected($kategori === $item)>{{ $item }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('dashboard.keuangan.laporan.download', request()->query()) }}" class="flex-1 px-5 py-3 bg-emerald-500 text-white rounded-xl text-sm font-bold text-center shadow-lg shadow-emerald-500/20 hover:bg-emerald-600 transition-all">Excel</a>
            <a href="{{ route('dashboard.keuangan.laporan.pdf', request()->query()) }}" class="flex-1 px-5 py-3 bg-rose-500 text-white rounded-xl text-sm font-bold text-center shadow-lg shadow-rose-500/20 hover:bg-rose-600 transition-all">PDF</a>
        </div>
    </div>
</form>

<div class="grid grid-cols-5 gap-4 mb-8">
    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-1">Saldo Awal</p>
        <h3 class="text-xl font-extrabold text-gray-800">Rp {{ number_format($laporan['saldo_awal'], 0, ',', '.') }}</h3>
    </div>
    <div class="bg-emerald-50 p-5 rounded-2xl border border-emerald-100">
        <p class="text-emerald-600 text-[10px] font-bold uppercase tracking-widest mb-1">Kas Masuk</p>
        <h3 class="text-xl font-extrabold text-emerald-700">Rp {{ number_format($laporan['total_pemasukan'], 0, ',', '.') }}</h3>
    </div>
    <div class="bg-rose-50 p-5 rounded-2xl border border-rose-100">
        <p class="text-rose-600 text-[10px] font-bold uppercase tracking-widest mb-1">Kas Keluar</p>
        <h3 class="text-xl font-extrabold text-rose-700">Rp {{ number_format($laporan['total_pengeluaran'], 0, ',', '.') }}</h3>
    </div>
    <div class="bg-blue-50 p-5 rounded-2xl border border-blue-100">
        <p class="text-primary text-[10px] font-bold uppercase tracking-widest mb-1">Mutasi Bersih</p>
        <h3 class="text-xl font-extrabold text-primary">Rp {{ number_format($laporan['mutasi_bersih'], 0, ',', '.') }}</h3>
    </div>
    <div class="bg-slate-900 p-5 rounded-2xl border border-slate-900 shadow-sm">
        <p class="text-blue-100 text-[10px] font-bold uppercase tracking-widest mb-1">Saldo Akhir</p>
        <h3 class="text-xl font-extrabold text-white">Rp {{ number_format($laporan['saldo_akhir'], 0, ',', '.') }}</h3>
    </div>
</div>

<div class="print-stack grid grid-cols-12 gap-8">
    <div class="print-full col-span-8">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-8 py-5 border-b border-gray-50 bg-gray-50/30 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-gray-700 uppercase tracking-widest">Buku Kas Umum</h3>
                    <p class="text-xs text-gray-400 mt-1">{{ \Carbon\Carbon::parse($periodeAwal)->format('d M Y') }} - {{ \Carbon\Carbon::parse($periodeAkhir)->format('d M Y') }}</p>
                </div>
                <button onclick="window.print()" class="no-print px-4 py-2 bg-white border border-gray-100 text-gray-500 rounded-xl text-xs font-bold hover:bg-gray-50 transition-all">Cetak / PDF</button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                        <tr>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">No. Bukti</th>
                            <th class="px-6 py-4">Uraian</th>
                            <th class="px-6 py-4">Akun</th>
                            <th class="px-6 py-4 text-right">Kas Masuk</th>
                            <th class="px-6 py-4 text-right">Kas Keluar</th>
                            <th class="px-6 py-4 text-right">Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-50 bg-slate-50">
                            <td colspan="6" class="px-6 py-4 font-bold text-gray-500">Saldo awal sebelum periode</td>
                            <td class="px-6 py-4 text-right font-extrabold text-gray-800">{{ number_format($laporan['saldo_awal'], 0, ',', '.') }}</td>
                        </tr>
                        @forelse($laporan['rows'] as $row)
                            <tr class="border-b border-gray-50">
                                <td class="px-6 py-4 text-gray-500">{{ \Carbon\Carbon::parse($row['tanggal'])->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 font-bold text-gray-600">{{ $row['nomor_bukti'] }}</td>
                                <td class="px-6 py-4">
                                    <p class="font-bold text-gray-700">{{ $row['uraian'] }}</p>
                                    <p class="text-[10px] text-gray-400 mt-1">{{ $row['kategori'] }}</p>
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-500">
                                    <div>Dr: {{ $row['akun_debit'] }}</div>
                                    <div>Cr: {{ $row['akun_kredit'] }}</div>
                                </td>
                                <td class="px-6 py-4 text-right font-bold text-emerald-600">{{ $row['debit'] > 0 ? number_format($row['debit'], 0, ',', '.') : '-' }}</td>
                                <td class="px-6 py-4 text-right font-bold text-rose-600">{{ $row['kredit'] > 0 ? number_format($row['kredit'], 0, ',', '.') : '-' }}</td>
                                <td class="px-6 py-4 text-right font-extrabold text-gray-800">{{ number_format($row['saldo'], 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-8 py-12 text-center text-gray-400">Belum ada transaksi pada periode ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mt-8">
            <div class="px-8 py-5 border-b border-gray-50 bg-gray-50/30">
                <h3 class="text-sm font-bold text-gray-700 uppercase tracking-widest">Jurnal Umum</h3>
                <p class="text-xs text-gray-400 mt-1">Format akuntansi berpasangan: setiap transaksi punya debit dan kredit yang sama.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                        <tr>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">No. Bukti</th>
                            <th class="px-6 py-4">Akun</th>
                            <th class="px-6 py-4">Keterangan</th>
                            <th class="px-6 py-4 text-right">Debit</th>
                            <th class="px-6 py-4 text-right">Kredit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporan['rows'] as $row)
                            <tr class="border-b border-gray-50">
                                <td rowspan="2" class="px-6 py-4 text-gray-500 align-top">{{ \Carbon\Carbon::parse($row['tanggal'])->format('d/m/Y') }}</td>
                                <td rowspan="2" class="px-6 py-4 font-bold text-gray-600 align-top">{{ $row['nomor_bukti'] }}</td>
                                <td class="px-6 py-3 font-bold text-gray-700">{{ $row['akun_debit'] }}</td>
                                <td rowspan="2" class="px-6 py-4 text-gray-500 align-top">{{ $row['uraian'] }}</td>
                                <td class="px-6 py-3 text-right font-bold text-emerald-700">{{ number_format($row['jurnal_debit'], 0, ',', '.') }}</td>
                                <td class="px-6 py-3 text-right text-gray-300">-</td>
                            </tr>
                            <tr class="border-b border-gray-50 bg-gray-50/30">
                                <td class="px-6 py-3 pl-10 text-gray-600">{{ $row['akun_kredit'] }}</td>
                                <td class="px-6 py-3 text-right text-gray-300">-</td>
                                <td class="px-6 py-3 text-right font-bold text-rose-700">{{ number_format($row['jurnal_kredit'], 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-8 py-12 text-center text-gray-400">Belum ada jurnal pada periode ini.</td>
                            </tr>
                        @endforelse
                        <tr class="bg-gray-50">
                            <td colspan="4" class="px-6 py-4 text-right font-extrabold text-gray-800">Total Jurnal</td>
                            <td class="px-6 py-4 text-right font-extrabold text-gray-800">{{ number_format($laporan['total_jurnal_debit'], 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-right font-extrabold text-gray-800">{{ number_format($laporan['total_jurnal_kredit'], 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="print-full col-span-4 space-y-8">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-50 bg-gray-50/30">
                <h3 class="text-sm font-bold text-gray-700 uppercase tracking-widest">Neraca Saldo</h3>
                <p class="text-xs text-gray-400 mt-1">Total jurnal debit dan kredit harus sama.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                        <tr>
                            <th class="px-5 py-3">Akun</th>
                            <th class="px-5 py-3 text-right">Debit</th>
                            <th class="px-5 py-3 text-right">Kredit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporan['ringkasan_akun'] as $akun)
                            <tr class="border-b border-gray-50">
                                <td class="px-5 py-3 font-bold text-gray-700">{{ $akun['akun'] }}</td>
                                <td class="px-5 py-3 text-right text-emerald-700 font-bold">{{ $akun['debit'] > 0 ? number_format($akun['debit'], 0, ',', '.') : '-' }}</td>
                                <td class="px-5 py-3 text-right text-rose-700 font-bold">{{ $akun['kredit'] > 0 ? number_format($akun['kredit'], 0, ',', '.') : '-' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="px-6 py-8 text-center text-gray-400">Belum ada akun.</td></tr>
                        @endforelse
                        <tr class="bg-gray-50">
                            <td class="px-5 py-3 font-extrabold text-gray-800">Total Jurnal</td>
                            <td class="px-5 py-3 text-right font-extrabold text-gray-800">{{ number_format($laporan['total_jurnal_debit'], 0, ',', '.') }}</td>
                            <td class="px-5 py-3 text-right font-extrabold text-gray-800">{{ number_format($laporan['total_jurnal_kredit'], 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-50 bg-gray-50/30">
                <h3 class="text-sm font-bold text-gray-700 uppercase tracking-widest">Rekap Kategori</h3>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($laporan['rekap_kategori'] as $rekap)
                    <div class="p-6">
                        <p class="text-sm font-extrabold text-gray-800">{{ $rekap['kategori'] }}</p>
                        <div class="grid grid-cols-2 gap-3 mt-4 text-xs">
                            <div class="bg-emerald-50 rounded-xl p-3">
                                <p class="text-emerald-600 font-bold">Pemasukan</p>
                                <p class="font-extrabold text-emerald-700 mt-1">Rp {{ number_format($rekap['pemasukan'], 0, ',', '.') }}</p>
                            </div>
                            <div class="bg-rose-50 rounded-xl p-3">
                                <p class="text-rose-600 font-bold">Pengeluaran</p>
                                <p class="font-extrabold text-rose-700 mt-1">Rp {{ number_format($rekap['pengeluaran'], 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="mt-3 bg-gray-50 rounded-xl p-3 text-xs">
                            <p class="text-gray-400 font-bold">Saldo Kategori</p>
                            <p class="font-extrabold text-gray-700 mt-1">Rp {{ number_format($rekap['saldo'], 0, ',', '.') }}</p>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-sm text-gray-400">Belum ada rekap.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
