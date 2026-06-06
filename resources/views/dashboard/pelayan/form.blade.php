@extends('dashboard.layouts.app')
@section('title', $type . ' Pelayan')

@section('content')
<x-dashboard.page-header
    title="{{ $type }} Pelayan Gereja"
    subtitle="Kelola pelayan ibadah seperti pemusik, singers, multimedia, usher, dan guru sekolah minggu."
    backUrl="{{ route('dashboard.pelayan.index') }}"
/>

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-10 max-w-4xl overflow-hidden relative">
    <form action="{{ $type == 'Edit' ? route('dashboard.pelayan.update', $pelayan->id ?? 0) : route('dashboard.pelayan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($type == 'Edit') @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="md:col-span-2">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-5">Data Pelayan</h3>
            </div>

            <x-form.input label="Nama Lengkap" name="nama" value="{{ old('nama', $pelayan->nama ?? '') }}" placeholder="Nama jemaat/pelayan..." />
            <x-form.input label="Nama Tampil" name="nama_tampilan" value="{{ old('nama_tampilan', $pelayan->nama_tampilan ?? '') }}" placeholder="Opsional, contoh: Daniel S." />

            <x-form.input label="No. Telepon / WhatsApp" name="no_telepon" type="text" value="{{ old('no_telepon', $pelayan->no_telepon ?? '') }}" placeholder="08xxxxxxxxxx" inputmode="numeric" pattern="[0-9]{8,15}" minlength="8" maxlength="15" oninput="this.value=this.value.replace(/\D/g,'').slice(0,15)" />
            <x-form.input label="Email" name="email" type="email" value="{{ old('email', $pelayan->email ?? '') }}" placeholder="email jemaat..." />

            <x-form.select label="Bidang Pelayanan" name="posisi">
                @foreach(['Pemusik', 'Singer / Worship Leader', 'Multimedia', 'Sound System', 'Usher', 'Penerima Tamu', 'Guru Sekolah Minggu', 'Doa Syafaat', 'Pembaca Firman', 'Kolektan', 'Lainnya'] as $posisi)
                    <option value="{{ $posisi }}" {{ old('posisi', $pelayan->posisi ?? '') == $posisi ? 'selected' : '' }}>{{ $posisi }}</option>
                @endforeach
            </x-form.select>

            <x-form.select label="Komisi / Area Layanan" name="komisi_tujuan">
                @foreach(['', 'Ibadah Umum', 'Komisi Anak', 'Komisi Remaja', 'Komisi Pemuda', 'Komisi Dewasa', 'Komisi Usia Indah', 'Tim Musik', 'Tim Multimedia'] as $komisi)
                    <option value="{{ $komisi }}" {{ old('komisi_tujuan', $pelayan->komisi_tujuan ?? '') == $komisi ? 'selected' : '' }}>{{ $komisi ?: 'Pilih area layanan...' }}</option>
                @endforeach
            </x-form.select>

            <x-form.select label="Status" name="status">
                <option value="aktif" {{ old('status', $pelayan->status ?? 'aktif') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="pending" {{ old('status', $pelayan->status ?? '') == 'pending' ? 'selected' : '' }}>Menunggu Approval</option>
                <option value="ditolak" {{ old('status', $pelayan->status ?? '') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                <option value="tidak aktif" {{ old('status', $pelayan->status ?? '') == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
            </x-form.select>

            <x-form.input label="Tanggal Mulai" name="tanggal_mulai" type="date" value="{{ old('tanggal_mulai', $pelayan->tanggal_mulai ?? now()->toDateString()) }}" />

            <x-form.input label="Urutan Tampil" name="urutan" type="number" value="{{ old('urutan', $pelayan->urutan ?? 0) }}" placeholder="0, 1, 2..." />
            <x-form.input label="Ikon Material Symbols" name="ikon" value="{{ old('ikon', $pelayan->ikon ?? '') }}" placeholder="music_note, mic, groups..." />

            <div class="md:col-span-2">
                <label class="block mb-3 font-bold text-primary text-[11px] uppercase tracking-widest">Foto Pelayan</label>
                <input type="file" name="foto" accept="image/png,image/jpeg,image/webp" class="w-full cursor-pointer px-5 py-4 rounded-xl border border-gray-100 bg-gray-50/30 outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-sm font-medium text-gray-700">
                <p class="mt-2 text-xs text-gray-400 font-medium">Hanya gambar JPG, PNG, atau WebP. Maksimal 2MB.</p>
                @if(isset($pelayan) && $pelayan->foto)
                    <p class="mt-2 text-xs text-gray-500">Foto saat ini: <a href="{{ asset('storage/' . $pelayan->foto) }}" target="_blank" class="text-primary underline">Lihat Foto</a></p>
                @endif
            </div>

            <div class="md:col-span-2">
                <label class="block mb-3 font-bold text-primary text-[11px] uppercase tracking-widest">Talenta / Alasan Pelayanan</label>
                <textarea name="alasan" rows="4" placeholder="Contoh: Bisa keyboard, gitar, vocal, multimedia, atau pengalaman pelayanan..." class="w-full px-5 py-4 rounded-xl border border-gray-100 bg-gray-50/30 outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-sm font-medium leading-relaxed shadow-inner">{{ old('alasan', $pelayan->alasan ?? '') }}</textarea>
            </div>

            <div class="md:col-span-2">
                <label class="block mb-3 font-bold text-primary text-[11px] uppercase tracking-widest">Catatan Singkat</label>
                <textarea name="deskripsi_singkat" rows="3" placeholder="Catatan admin atau keterangan singkat..." class="w-full px-5 py-4 rounded-xl border border-gray-100 bg-gray-50/30 outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-sm font-medium leading-relaxed shadow-inner">{{ old('deskripsi_singkat', $pelayan->deskripsi_singkat ?? '') }}</textarea>
            </div>
        </div>

        <input type="hidden" name="kategori_halaman" value="{{ old('kategori_halaman', $pelayan->kategori_halaman ?? 'pelayan') }}">
        <input type="hidden" name="kelompok_layanan" value="{{ old('kelompok_layanan', $pelayan->kelompok_layanan ?? 'pelayan_ibadah') }}">

        <div class="flex items-center gap-4 pt-8 mt-8 border-t border-gray-50">
            <button type="submit" class="px-10 py-4 bg-primary text-white rounded-2xl text-sm font-bold shadow-xl shadow-primary/20 hover:bg-blue-700 transition-all">
                {{ $type == 'Tambah' ? 'Tambahkan Pelayan' : 'Simpan Perubahan' }}
            </button>
            <a href="{{ route('dashboard.pelayan.index') }}" class="px-10 py-4 bg-gray-50 text-gray-400 rounded-2xl text-sm font-bold hover:bg-gray-100 transition-all">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
