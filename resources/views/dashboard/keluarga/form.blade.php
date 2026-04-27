@extends('dashboard.layouts.app')
@section('title', $type . ' Keluarga')

@section('content')
<x-dashboard.page-header 
    title="{{ $type }} Data Keluarga" 
    subtitle="Lengkapi informasi kepala keluarga dan dokumen pendukung." 
    backUrl="{{ route('dashboard.keluarga.index') }}" 
/>

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-12 overflow-hidden relative">
    <!-- Decorative background element -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-primary/5 rounded-full -mr-32 -mt-32 blur-3xl"></div>

    <form action="#" method="POST" class="max-w-4xl relative z-10">
        <div class="grid grid-cols-2 gap-10 mb-12">
            <x-form.input label="Nomor Kartu Keluarga (No KK)" name="no_kk" value="{{ $keluarga['no_kk'] ?? '' }}" placeholder="16 digit nomor KK..." :readonly="$type == 'Edit'" />
            <x-form.input label="Nama Keluarga" name="nama" value="{{ $keluarga['nama'] ?? '' }}" placeholder="Nama kepala keluarga..." />
            
            <x-form.select label="Sektor" name="sektor">
                <option value="">Pilih Sektor</option>
                @for($i=1; $i<=5; $i++)
                    <option value="{{ $i }}">Sektor {{ $i }}</option>
                @endfor
            </x-form.select>

            <x-form.input label="Tanggal Pernikahan" name="tanggal_nikah" type="date" value="{{ $keluarga['tanggal_nikah'] ?? '' }}" />
            
            <x-form.select label="Status" name="status">
                <option value="Aktif">Aktif</option>
                <option value="Pindah">Pindah</option>
                <option value="Meninggal">Meninggal</option>
            </x-form.select>

            <div class="col-span-2">
                <x-form.input label="Alamat Lengkap" name="alamat" value="{{ $keluarga['alamat'] ?? '' }}" placeholder="Jalan, No. Rumah, RT/RW..." />
            </div>

            <div class="col-span-2">
                <label class="block mb-3 font-bold text-primary text-[11px] uppercase tracking-widest">Lampiran (Upload File KK)</label>
                <div class="border-2 border-dashed border-gray-100 rounded-2xl p-10 text-center bg-gray-50 hover:bg-white hover:border-primary transition-all cursor-pointer group">
                    <svg class="w-10 h-10 text-gray-300 mx-auto mb-4 group-hover:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                    <p class="text-sm font-bold text-gray-400">Pilih file atau seret ke sini</p>
                    <p class="text-[10px] text-gray-300 mt-1 uppercase font-bold tracking-widest">PDF, JPG, PNG (Maks. 2MB)</p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4 pt-8 border-t border-gray-50">
            <button type="submit" class="px-8 py-3.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all">
                {{ $type == 'Tambah' ? 'Simpan Data' : 'Ubah Data' }}
            </button>
            <button type="reset" class="px-8 py-3.5 bg-gray-50 text-gray-400 rounded-xl text-sm font-bold hover:bg-gray-100 transition-all">
                Reset
            </button>
        </div>
    </form>
</div>
@endsection
