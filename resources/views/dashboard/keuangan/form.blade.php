@extends('dashboard.layouts.app')
@section('title', 'Tambah Data Keuangan')

@section('content')
<x-dashboard.page-header 
    title="Tambah Data Keuangan" 
    subtitle="Catat transaksi pemasukan atau pengeluaran kas gereja." 
    backUrl="{{ route('dashboard.keuangan.index') }}" 
/>

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-12 overflow-hidden relative max-w-4xl">
    <form action="#" method="POST">
        <div class="grid grid-cols-2 gap-10 mb-12">
            <x-form.select label="Kategori" name="kategori">
                <option value="">Pilih Kategori</option>
                <option value="Persembahan Ibadah">Persembahan Ibadah</option>
                <option value="Diakoni Sosial">Diakoni Sosial</option>
                <option value="Persembahan Khusus">Persembahan Khusus</option>
                <option value="Pembangunan">Pembangunan</option>
                <option value="Operasional">Operasional</option>
            </x-form.select>

            <x-form.select label="Jenis Transaksi" name="jenis">
                <option value="Pemasukan">Pemasukan (Kredit)</option>
                <option value="Pengeluaran">Pengeluaran (Debit)</option>
            </x-form.select>

            <div class="col-span-2">
                <x-form.input label="Keterangan" name="keterangan" placeholder="Contoh: Persembahan Kantong 1 - Kebaktian Pagi" />
            </div>

            <x-form.input label="Tanggal Transaksi" name="tanggal" type="date" />
            
            <div class="flex flex-col gap-2">
                <label class="text-[11px] font-bold text-primary uppercase tracking-widest">Nominal (Rp)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-5 flex items-center text-gray-400 font-bold text-sm">Rp</span>
                    <input type="number" name="nominal" placeholder="0" class="w-full pl-12 pr-5 py-3.5 rounded-xl border border-gray-100 bg-gray-50/30 outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-sm font-bold text-gray-700">
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4 pt-8 border-t border-gray-50">
            <button type="submit" class="px-8 py-3.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all">
                Tambah Data Keuangan
            </button>
            <button type="reset" class="px-8 py-3.5 bg-gray-50 text-gray-400 rounded-xl text-sm font-bold hover:bg-gray-100 transition-all">
                Reset
            </button>
        </div>
    </form>
</div>
@endsection
