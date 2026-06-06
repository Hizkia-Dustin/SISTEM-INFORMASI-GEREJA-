@extends('dashboard.layouts.app')
@section('title', $type . ' Jadwal Pelayanan')

@section('content')
<x-dashboard.page-header
    title="{{ $type }} Jadwal Pelayanan"
    subtitle="Tentukan petugas pelayanan untuk setiap peran dalam ibadah."
    backUrl="{{ route('dashboard.tugas.index') }}"
/>

@php
    $fieldValue = function (string $field, ?string $fallback = null) use ($tugasRoles, $tugas) {
        return old($field, $tugasRoles[$field] ?? $fallback ?? '');
    };

    $renderPelayanSelect = function (string $label, string $name, $options, ?string $fallback = null) use ($fieldValue) {
        $selected = $fieldValue($name, $fallback);
        $options = collect($options ?? [])->filter()->unique()->values();
@endphp
        <div>
            <label class="block mb-2 font-medium text-gray-700 text-sm">{{ $label }}</label>
            <div class="relative">
                <select name="{{ $name }}" class="w-full pr-10 px-4 py-3 rounded-xl border border-gray-200 bg-white outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-sm shadow-sm appearance-none cursor-pointer">
                    <option value="">{{ $options->isEmpty() ? 'Belum ada pelayan aktif' : 'Pilih Nama Pelayan...' }}</option>
                    @foreach($options as $option)
                        <option value="{{ $option }}" {{ $selected === $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>
        </div>
@php
    };
@endphp

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8 xl:p-12 overflow-hidden relative">
    @if(($pelayanOptions['all'] ?? collect())->isEmpty())
        <div class="mb-8 rounded-2xl border border-amber-100 bg-amber-50 px-5 py-4 text-sm font-semibold text-amber-700">
            Belum ada data pelayan aktif. Tambahkan dulu lewat menu Pelayan Gereja, atau approve pendaftaran pelayanan yang masih menunggu.
        </div>
    @endif

    <form action="{{ $type == 'Edit' ? route('dashboard.tugas.update', $tugas->id ?? 0) : route('dashboard.tugas.store') }}" method="POST">
        @csrf
        @if($type == 'Edit') @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
            <x-form.input label="Nama Ibadah / Kegiatan" name="judul" value="{{ old('judul', $tugas->judul ?? 'Jadwal Pelayanan') }}" placeholder="Contoh: Ibadah Minggu Pagi" />
            <x-form.input label="Tanggal Pelayanan" name="tanggal" type="date" value="{{ old('tanggal', $tugas->deadline ?? now()->toDateString()) }}" />
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-12">
            <div class="flex flex-col gap-8">
                <h3 class="text-xs font-bold text-primary uppercase tracking-widest flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                    Pelayan Utama
                </h3>
                {{ $renderPelayanSelect('Pengkhotbah', 'pengkhotbah', $pelayanOptions['pengkhotbah'] ?? collect(), $tugas->penerima ?? null) }}
                {{ $renderPelayanSelect('Liturgis', 'liturgis', $pelayanOptions['liturgis'] ?? collect()) }}
                {{ $renderPelayanSelect('Doa Syafaat', 'doa_syafaat', $pelayanOptions['doa_syafaat'] ?? collect()) }}
                {{ $renderPelayanSelect('Warta Jemaat', 'warta', $pelayanOptions['warta'] ?? collect()) }}
            </div>

            <div class="flex flex-col gap-8">
                <h3 class="text-xs font-bold text-emerald-500 uppercase tracking-widest flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    Tim Musik & Liturgis
                </h3>
                {{ $renderPelayanSelect('Pemusik', 'pemusik', $pelayanOptions['pemusik'] ?? collect()) }}
                {{ $renderPelayanSelect('Song Leader', 'song_leader', $pelayanOptions['song_leader'] ?? collect()) }}
                {{ $renderPelayanSelect('Liturgis Sekolah Minggu', 'liturgis_sm', $pelayanOptions['liturgis_sm'] ?? collect()) }}

                <div class="grid grid-cols-1 gap-4">
                    <label class="block font-bold text-primary text-[11px] uppercase tracking-widest">Pengumpul Persembahan (1-4)</label>
                    {{ $renderPelayanSelect('Petugas 1', 'pengumpul_1', $pelayanOptions['pengumpul'] ?? collect()) }}
                    {{ $renderPelayanSelect('Petugas 2', 'pengumpul_2', $pelayanOptions['pengumpul'] ?? collect()) }}
                    {{ $renderPelayanSelect('Petugas 3', 'pengumpul_3', $pelayanOptions['pengumpul'] ?? collect()) }}
                    {{ $renderPelayanSelect('Petugas 4', 'pengumpul_4', $pelayanOptions['pengumpul'] ?? collect()) }}
                </div>
            </div>

            <div class="flex flex-col gap-8">
                <h3 class="text-xs font-bold text-amber-500 uppercase tracking-widest flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                    Penerima Tamu (Usher)
                </h3>
                {{ $renderPelayanSelect('Penerima Tamu 1', 'penerima_tamu_1', $pelayanOptions['penerima_tamu'] ?? collect()) }}
                {{ $renderPelayanSelect('Penerima Tamu 2', 'penerima_tamu_2', $pelayanOptions['penerima_tamu'] ?? collect()) }}
                {{ $renderPelayanSelect('Penerima Tamu 3', 'penerima_tamu_3', $pelayanOptions['penerima_tamu'] ?? collect()) }}

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
