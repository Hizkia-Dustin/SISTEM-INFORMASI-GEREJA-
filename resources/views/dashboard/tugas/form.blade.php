@extends('dashboard.layouts.app')
@section('title', $type . ' Jadwal Pelayanan')

@section('content')
<x-dashboard.page-header 
    title="{{ $type }} Jadwal Pelayanan" 
    subtitle="Tentukan petugas pelayanan untuk setiap peran dalam ibadah." 
    backUrl="{{ route('dashboard.tugas.index') }}" 
/>

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-12 overflow-hidden relative">
    <form action="{{ $type == 'Edit' ? route('dashboard.tugas.update', $tugas->id ?? 0) : route('dashboard.tugas.store') }}" method="POST">
        @csrf
        @if($type == 'Edit') @method('PUT') @endif
        <div class="grid grid-cols-3 gap-12">
            <!-- Core Roles -->
            <div class="flex flex-col gap-8">
                <h3 class="text-xs font-bold text-primary uppercase tracking-widest flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                    Pelayan Utama
                </h3>
                <x-form.select label="Pengkhotbah" name="pengkhotbah">
                    <option value="">Pilih Nama Pelayan...</option>
                </x-form.select>
                <x-form.select label="Liturgis" name="liturgis">
                    <option value="">Pilih Nama Pelayan...</option>
                </x-form.select>
                <x-form.select label="Doa Syafaat" name="doa_syafaat">
                    <option value="">Pilih Nama Pelayan...</option>
                </x-form.select>
                <x-form.select label="Warta Jemaat" name="warta">
                    <option value="">Pilih Nama Pelayan...</option>
                </x-form.select>
            </div>

            <!-- Supporting Roles -->
            <div class="flex flex-col gap-8">
                <h3 class="text-xs font-bold text-emerald-500 uppercase tracking-widest flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    Tim Musik & Liturgis
                </h3>
                <x-form.select label="Pemusik" name="pemusik">
                    <option value="">Pilih Nama Pelayan...</option>
                </x-form.select>
                <x-form.select label="Song Leader" name="song_leader">
                    <option value="">Pilih Nama Pelayan...</option>
                </x-form.select>
                <x-form.select label="Liturgis Sekolah Minggu" name="liturgis_sm">
                    <option value="">Pilih Nama Pelayan...</option>
                </x-form.select>
                <div class="grid grid-cols-1 gap-4">
                    <label class="block font-bold text-primary text-[11px] uppercase tracking-widest">Pengumpul Persembahan (1-4)</label>
                    <select class="w-full px-4 py-2 bg-gray-50 border-none rounded-lg text-xs font-medium focus:ring-2 focus:ring-primary/10 mb-2"><option>Pilih Petugas 1...</option></select>
                    <select class="w-full px-4 py-2 bg-gray-50 border-none rounded-lg text-xs font-medium focus:ring-2 focus:ring-primary/10 mb-2"><option>Pilih Petugas 2...</option></select>
                    <select class="w-full px-4 py-2 bg-gray-50 border-none rounded-lg text-xs font-medium focus:ring-2 focus:ring-primary/10 mb-2"><option>Pilih Petugas 3...</option></select>
                    <select class="w-full px-4 py-2 bg-gray-50 border-none rounded-lg text-xs font-medium focus:ring-2 focus:ring-primary/10"><option>Pilih Petugas 4...</option></select>
                </div>
            </div>

            <!-- Usher / Tamu -->
            <div class="flex flex-col gap-8">
                <h3 class="text-xs font-bold text-amber-500 uppercase tracking-widest flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                    Penerima Tamu (Usher)
                </h3>
                <div class="grid grid-cols-1 gap-4">
                    <select class="w-full px-4 py-2 bg-gray-50 border-none rounded-lg text-xs font-medium focus:ring-2 focus:ring-primary/10 mb-2"><option>Pilih Penerima Tamu 1...</option></select>
                    <select class="w-full px-4 py-2 bg-gray-50 border-none rounded-lg text-xs font-medium focus:ring-2 focus:ring-primary/10 mb-2"><option>Pilih Penerima Tamu 2...</option></select>
                    <select class="w-full px-4 py-2 bg-gray-50 border-none rounded-lg text-xs font-medium focus:ring-2 focus:ring-primary/10"><option>Pilih Penerima Tamu 3...</option></select>
                </div>

                <div class="mt-auto flex flex-col gap-3">
                    <button type="submit" class="w-full py-4 bg-primary text-white rounded-2xl text-sm font-bold shadow-xl shadow-primary/20 hover:bg-blue-700 transition-all">
                        Simpan Jadwal Pelayanan
                    </button>
                    <button type="reset" class="w-full py-4 bg-white border border-gray-100 text-gray-400 rounded-2xl text-sm font-bold hover:bg-gray-50 transition-all">
                        Reset Form
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
