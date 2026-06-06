@extends('dashboard.layouts.app')
@section('title', 'Tambah Data Keuangan')

@section('content')
<x-dashboard.page-header 
    title="Tambah Data Keuangan" 
    subtitle="Catat transaksi pemasukan atau pengeluaran kas gereja." 
    backUrl="{{ route('dashboard.keuangan.index') }}" 
/>

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-12 overflow-hidden relative max-w-4xl">
    <form action="{{ $type == 'Edit' ? route('dashboard.keuangan.update', $keuangan->id ?? 0) : route('dashboard.keuangan.store') }}" method="POST">
        @csrf
        @if($type == 'Edit') @method('PUT') @endif
        <div class="grid grid-cols-2 gap-10 mb-12">
            <x-form.select label="Kategori" name="kategori">
                <option value="">Pilih Kategori</option>
                <option value="Persembahan Ibadah" {{ (old('kategori', $keuangan->kategori ?? '')) == 'Persembahan Ibadah' ? 'selected' : '' }}>Persembahan Ibadah</option>
                <option value="Diakoni Sosial" {{ (old('kategori', $keuangan->kategori ?? '')) == 'Diakoni Sosial' ? 'selected' : '' }}>Diakoni Sosial</option>
                <option value="Persembahan Khusus" {{ (old('kategori', $keuangan->kategori ?? '')) == 'Persembahan Khusus' ? 'selected' : '' }}>Persembahan Khusus</option>
                <option value="Pembangunan" {{ (old('kategori', $keuangan->kategori ?? '')) == 'Pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                <option value="Operasional" {{ (old('kategori', $keuangan->kategori ?? '')) == 'Operasional' ? 'selected' : '' }}>Operasional</option>
            </x-form.select>

            <x-form.select label="Jenis Transaksi" name="jenis_transaksi">
                <option value="Pemasukan" {{ (old('jenis_transaksi', $keuangan->jenis_transaksi ?? '')) == 'Pemasukan' ? 'selected' : '' }}>Pemasukan (Kredit)</option>
                <option value="Pengeluaran" {{ (old('jenis_transaksi', $keuangan->jenis_transaksi ?? '')) == 'Pengeluaran' ? 'selected' : '' }}>Pengeluaran (Debit)</option>
            </x-form.select>

            <div class="col-span-2">
                <x-form.input label="Keterangan" name="keterangan" :value="old('keterangan', $keuangan->keterangan ?? '')" placeholder="Contoh: Persembahan Kantong 1 - Kebaktian Pagi" />
            </div>

            <x-form.input label="Tanggal Transaksi" name="tanggal" type="date" :value="old('tanggal', $keuangan->tanggal ?? '')" />
            
            <div class="flex flex-col gap-2">
                <label class="text-[11px] font-bold text-primary uppercase tracking-widest">Nominal (Rp)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-5 flex items-center text-gray-400 font-bold text-sm">Rp</span>
                    <input type="number" name="jumlah" value="{{ old('jumlah', isset($keuangan->jumlah) ? abs((float) $keuangan->jumlah) : '') }}" min="0" step="1" inputmode="numeric" placeholder="0" class="w-full pl-12 pr-5 py-3.5 rounded-xl border border-gray-100 bg-gray-50/30 outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-sm font-bold text-gray-700">
                </div>
                <p class="text-xs text-gray-400 font-medium">Isi nominal positif saja. Pemasukan atau pengeluaran ditentukan dari jenis transaksi.</p>
            </div>
        </div>

        <div class="flex items-center gap-4 pt-8 border-t border-gray-50">
            <button type="submit" class="px-8 py-3.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all">
                {{ $type == 'Edit' ? 'Simpan Perubahan' : 'Tambah Data Keuangan' }}
            </button>
            <button type="reset" class="px-8 py-3.5 bg-gray-50 text-gray-400 rounded-xl text-sm font-bold hover:bg-gray-100 transition-all">
                Reset
            </button>
        </div>
    </form>
</div>
@endsection
