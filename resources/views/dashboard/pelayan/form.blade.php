@extends('dashboard.layouts.app')
@section('title', $type . ' Pelayan')

@section('content')
<x-dashboard.page-header 
    title="{{ $type }} Pelayan Gereja" 
    subtitle="Tugaskan jemaat sebagai pelayan (Pendeta, Penatua, atau Diaken)." 
    backUrl="{{ route('dashboard.pelayan.index') }}" 
/>

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-12 max-w-3xl overflow-hidden relative">
    <form action="#" method="POST">
        <div class="flex flex-col gap-10">
            <!-- NIK Selector -->
            <div>
                <label class="block mb-3 font-bold text-primary text-[11px] uppercase tracking-widest">Pilih Jemaat (NIK)</label>
                <div class="relative">
                    <select name="nik" class="w-full px-5 py-4 rounded-xl border border-gray-100 bg-gray-50/30 outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-sm font-bold text-gray-700 appearance-none">
                        <option value="">Cari NIK atau Nama Jemaat...</option>
                        <option value="3273010101010001">3273010101010001 - Budi Santoso</option>
                        <option value="3273010101010002">3273010101010002 - Agus Wijaya</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-5 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>
                <p class="mt-2 text-[10px] text-gray-400 font-medium italic">*Hanya jemaat yang belum menjabat sebagai pelayan yang muncul di daftar.</p>
            </div>

            <!-- Peran -->
            <x-form.select label="Peran / Jabatan" name="peran">
                <option value="Pendeta">Pendeta</option>
                <option value="Penatua">Penatua</option>
                <option value="Diaken">Diaken</option>
                <option value="Penginjil">Penginjil</option>
            </x-form.select>

            <!-- Jabatan Period -->
            <div class="grid grid-cols-2 gap-8">
                <x-form.input label="Tanggal Terima Jabatan" name="tanggal_terima" type="date" />
                <x-form.input label="Tanggal Akhir Jabatan" name="tanggal_akhir" type="date" />
            </div>

            <!-- Submit -->
            <div class="flex items-center gap-4 pt-8 border-t border-gray-50">
                <button type="submit" class="px-10 py-4 bg-primary text-white rounded-2xl text-sm font-bold shadow-xl shadow-primary/20 hover:bg-blue-700 transition-all">
                    {{ $type == 'Tambah' ? 'Tambahkan Data Pelayan' : 'Ubah Data Pelayan' }}
                </button>
                <button type="reset" class="px-10 py-4 bg-gray-50 text-gray-400 rounded-2xl text-sm font-bold hover:bg-gray-100 transition-all">
                    Reset
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
