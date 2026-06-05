@extends('dashboard.layouts.app')
@section('title', $type . ' Komisi')

@section('content')
<x-dashboard.page-header 
    title="{{ $type }} Komisi / Bagian" 
    subtitle="Kelola struktur organisasi komisi kategorial dan fungsional." 
    backUrl="{{ route('dashboard.komisi.index') }}" 
/>

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-12 max-w-2xl overflow-hidden relative">
    <form action="{{ $type == 'Edit' ? route('dashboard.komisi.update', $komisi->id ?? 0) : route('dashboard.komisi.store') }}" method="POST">
        @csrf
        @if($type == 'Edit') @method('PUT') @endif
        <div class="flex flex-col gap-8">
            <x-form.input label="Nama Komisi / Bagian" name="nama" value="{{ old('nama', $komisi->nama ?? '') }}" placeholder="Contoh: Komisi Anak, Komisi Musik, dll." />
            
            <x-form.select label="Kategori Komisi" name="kategori">
                <option value="Kategorial" {{ old('kategori', $komisi->status ?? '') == 'Kategorial' ? 'selected' : '' }}>Kategorial (Berdasarkan Usia)</option>
                <option value="Fungsional" {{ old('kategori', $komisi->status ?? '') == 'Fungsional' ? 'selected' : '' }}>Fungsional (Berdasarkan Pelayanan)</option>
            </x-form.select>

            <div>
                <label class="block mb-3 font-bold text-primary text-[11px] uppercase tracking-widest">Keterangan / Tugas</label>
                <textarea name="keterangan" rows="6" placeholder="Deskripsi tugas dan fungsi komisi..." class="w-full px-5 py-4 rounded-xl border border-gray-100 bg-gray-50/30 outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-sm font-medium leading-relaxed shadow-inner">{{ old('keterangan', $komisi->deskripsi ?? '') }}</textarea>
            </div>

            <!-- Submit -->
            <div class="flex items-center gap-4 pt-8 border-t border-gray-50">
                <button type="submit" class="px-10 py-4 bg-primary text-white rounded-2xl text-sm font-bold shadow-xl shadow-primary/20 hover:bg-blue-700 transition-all">
                    {{ $type == 'Tambah' ? 'Simpan Komisi' : 'Ubah Komisi' }}
                </button>
                <button type="reset" class="px-10 py-4 bg-gray-50 text-gray-400 rounded-2xl text-sm font-bold hover:bg-gray-100 transition-all">
                    Reset
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
