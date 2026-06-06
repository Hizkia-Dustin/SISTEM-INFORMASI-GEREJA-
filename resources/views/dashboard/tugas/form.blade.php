@extends('dashboard.layouts.app')
@section('title', $type . ' Jadwal Pelayanan')

@section('content')
<x-dashboard.page-header
    title="{{ $type }} Jadwal Pelayanan"
    subtitle="Tentukan petugas pelayanan untuk setiap peran dalam ibadah."
    backUrl="{{ route('dashboard.tugas.index') }}"
/>

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
                @include('dashboard.tugas.partials.pelayan-select', ['label' => 'Pengkhotbah', 'name' => 'pengkhotbah', 'options' => $pelayanOptions['pengkhotbah'] ?? collect(), 'selected' => $tugasRoles['pengkhotbah'] ?? $tugas->penerima ?? ''])
                @include('dashboard.tugas.partials.pelayan-select', ['label' => 'Liturgis', 'name' => 'liturgis', 'options' => $pelayanOptions['liturgis'] ?? collect(), 'selected' => $tugasRoles['liturgis'] ?? ''])
                @include('dashboard.tugas.partials.pelayan-select', ['label' => 'Doa Syafaat', 'name' => 'doa_syafaat', 'options' => $pelayanOptions['doa_syafaat'] ?? collect(), 'selected' => $tugasRoles['doa_syafaat'] ?? ''])
                @include('dashboard.tugas.partials.pelayan-select', ['label' => 'Warta Jemaat', 'name' => 'warta', 'options' => $pelayanOptions['warta'] ?? collect(), 'selected' => $tugasRoles['warta'] ?? ''])
            </div>

            <div class="flex flex-col gap-8">
                <h3 class="text-xs font-bold text-emerald-500 uppercase tracking-widest flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    Tim Musik & Liturgis
                </h3>
                @include('dashboard.tugas.partials.pelayan-select', ['label' => 'Pemusik', 'name' => 'pemusik', 'options' => $pelayanOptions['pemusik'] ?? collect(), 'selected' => $tugasRoles['pemusik'] ?? ''])
                @include('dashboard.tugas.partials.pelayan-select', ['label' => 'Song Leader', 'name' => 'song_leader', 'options' => $pelayanOptions['song_leader'] ?? collect(), 'selected' => $tugasRoles['song_leader'] ?? ''])
                @include('dashboard.tugas.partials.pelayan-select', ['label' => 'Liturgis Sekolah Minggu', 'name' => 'liturgis_sm', 'options' => $pelayanOptions['liturgis_sm'] ?? collect(), 'selected' => $tugasRoles['liturgis_sm'] ?? ''])

                <div class="grid grid-cols-1 gap-4">
                    <label class="block font-bold text-primary text-[11px] uppercase tracking-widest">Pengumpul Persembahan (1-4)</label>
                    @include('dashboard.tugas.partials.pelayan-select', ['label' => 'Petugas 1', 'name' => 'pengumpul_1', 'options' => $pelayanOptions['pengumpul'] ?? collect(), 'selected' => $tugasRoles['pengumpul_1'] ?? ''])
                    @include('dashboard.tugas.partials.pelayan-select', ['label' => 'Petugas 2', 'name' => 'pengumpul_2', 'options' => $pelayanOptions['pengumpul'] ?? collect(), 'selected' => $tugasRoles['pengumpul_2'] ?? ''])
                    @include('dashboard.tugas.partials.pelayan-select', ['label' => 'Petugas 3', 'name' => 'pengumpul_3', 'options' => $pelayanOptions['pengumpul'] ?? collect(), 'selected' => $tugasRoles['pengumpul_3'] ?? ''])
                    @include('dashboard.tugas.partials.pelayan-select', ['label' => 'Petugas 4', 'name' => 'pengumpul_4', 'options' => $pelayanOptions['pengumpul'] ?? collect(), 'selected' => $tugasRoles['pengumpul_4'] ?? ''])
                </div>
            </div>

            <div class="flex flex-col gap-8">
                <h3 class="text-xs font-bold text-amber-500 uppercase tracking-widest flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                    Penerima Tamu (Usher)
                </h3>
                @include('dashboard.tugas.partials.pelayan-select', ['label' => 'Penerima Tamu 1', 'name' => 'penerima_tamu_1', 'options' => $pelayanOptions['penerima_tamu'] ?? collect(), 'selected' => $tugasRoles['penerima_tamu_1'] ?? ''])
                @include('dashboard.tugas.partials.pelayan-select', ['label' => 'Penerima Tamu 2', 'name' => 'penerima_tamu_2', 'options' => $pelayanOptions['penerima_tamu'] ?? collect(), 'selected' => $tugasRoles['penerima_tamu_2'] ?? ''])
                @include('dashboard.tugas.partials.pelayan-select', ['label' => 'Penerima Tamu 3', 'name' => 'penerima_tamu_3', 'options' => $pelayanOptions['penerima_tamu'] ?? collect(), 'selected' => $tugasRoles['penerima_tamu_3'] ?? ''])

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
