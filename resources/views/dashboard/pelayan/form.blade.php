@extends('dashboard.layouts.app')
@section('title', $type . ' Pelayan')

@section('content')
<x-dashboard.page-header 
    title="{{ $type }} Pelayan Gereja" 
    subtitle="Tugaskan jemaat sebagai pelayan (Pendeta, Penatua, atau Diaken)." 
    backUrl="{{ route('dashboard.pelayan.index') }}" 
/>

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-12 max-w-3xl overflow-hidden relative">
    <form action="{{ $type == 'Edit' ? route('dashboard.pelayan.update', $pelayan->id ?? 0) : route('dashboard.pelayan.store') }}" method="POST">
        @csrf
        @if($type == 'Edit') @method('PUT') @endif
        <div class="flex flex-col gap-10">
            <!-- Nama -->
            <x-form.input label="Nama Lengkap" name="nama" value="{{ old('nama', $pelayan->nama ?? '') }}" placeholder="Masukkan nama pelayan..." />

            <div class="grid grid-cols-2 gap-8">
                <x-form.input label="Email" name="email" type="email" value="{{ old('email', $pelayan->email ?? '') }}" placeholder="email jemaat..." />
                <x-form.input label="No. Telepon / WhatsApp" name="no_telepon" value="{{ old('no_telepon', $pelayan->no_telepon ?? '') }}" placeholder="08xxxxxxxxxx" />
            </div>

            <!-- Posisi -->
            <x-form.select label="Posisi / Jabatan" name="posisi">
                <option value="Pendeta" {{ (old('posisi', $pelayan->posisi ?? '') == 'Pendeta') ? 'selected' : '' }}>Pendeta</option>
                <option value="Penatua" {{ (old('posisi', $pelayan->posisi ?? '') == 'Penatua') ? 'selected' : '' }}>Penatua</option>
                <option value="Diaken" {{ (old('posisi', $pelayan->posisi ?? '') == 'Diaken') ? 'selected' : '' }}>Diaken</option>
                <option value="Penginjil" {{ (old('posisi', $pelayan->posisi ?? '') == 'Penginjil') ? 'selected' : '' }}>Penginjil</option>
                <option value="Pengurus Komisi" {{ (old('posisi', $pelayan->posisi ?? '') == 'Pengurus Komisi') ? 'selected' : '' }}>Pengurus Komisi</option>
                <option value="Guru Sekolah Minggu" {{ (old('posisi', $pelayan->posisi ?? '') == 'Guru Sekolah Minggu') ? 'selected' : '' }}>Guru Sekolah Minggu</option>
                <option value="Tim Musik" {{ (old('posisi', $pelayan->posisi ?? '') == 'Tim Musik') ? 'selected' : '' }}>Tim Musik</option>
                <option value="Multimedia" {{ (old('posisi', $pelayan->posisi ?? '') == 'Multimedia') ? 'selected' : '' }}>Multimedia</option>
                <option value="Usher" {{ (old('posisi', $pelayan->posisi ?? '') == 'Usher') ? 'selected' : '' }}>Usher</option>
            </x-form.select>

            <x-form.select label="Komisi Tujuan" name="komisi_tujuan">
                @foreach(['', 'Komisi Anak', 'Komisi Remaja', 'Komisi Pemuda', 'Komisi Dewasa', 'Komisi Usia Indah'] as $komisi)
                    <option value="{{ $komisi }}" {{ old('komisi_tujuan', $pelayan->komisi_tujuan ?? '') == $komisi ? 'selected' : '' }}>{{ $komisi ?: 'Pilih komisi...' }}</option>
                @endforeach
            </x-form.select>

            <!-- Status -->
            <x-form.select label="Status" name="status">
                <option value="aktif" {{ (old('status', $pelayan->status ?? '') == 'aktif') ? 'selected' : '' }}>Aktif</option>
                <option value="pending" {{ (old('status', $pelayan->status ?? '') == 'pending') ? 'selected' : '' }}>Menunggu Approval</option>
                <option value="ditolak" {{ (old('status', $pelayan->status ?? '') == 'ditolak') ? 'selected' : '' }}>Ditolak</option>
                <option value="tidak aktif" {{ (old('status', $pelayan->status ?? '') == 'tidak aktif') ? 'selected' : '' }}>Tidak Aktif</option>
            </x-form.select>

            <div>
                <label class="block mb-3 font-bold text-primary text-[11px] uppercase tracking-widest">Alasan / Talenta</label>
                <textarea name="alasan" rows="5" class="w-full px-5 py-4 rounded-xl border border-gray-100 bg-gray-50/30 outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-sm font-medium leading-relaxed shadow-inner">{{ old('alasan', $pelayan->alasan ?? '') }}</textarea>
            </div>

            <!-- Jabatan Period -->
            <div class="grid grid-cols-1 gap-8">
                <x-form.input label="Tanggal Mulai Jabatan" name="tanggal_mulai" type="date" value="{{ old('tanggal_mulai', $pelayan->tanggal_mulai ?? '') }}" />
            </div>

            <!-- Submit -->
            <div class="flex items-center gap-4 pt-8 border-t border-gray-50">
                <button type="submit" class="px-10 py-4 bg-primary text-white rounded-2xl text-sm font-bold shadow-xl shadow-primary/20 hover:bg-blue-700 transition-all">
                    {{ $type == 'Tambah' ? 'Tambahkan Data Pelayan' : 'Simpan Perubahan' }}
                </button>
                <button type="reset" class="px-10 py-4 bg-gray-50 text-gray-400 rounded-2xl text-sm font-bold hover:bg-gray-100 transition-all">
                    Reset
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
