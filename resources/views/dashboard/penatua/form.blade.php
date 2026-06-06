@extends('dashboard.layouts.app')
@section('title', $type . ' Penatua')

@section('content')
<x-dashboard.page-header 
    title="{{ $type }} Penatua" 
    subtitle="Kelola susunan kepengurusan penatua, bidang kerja, pendamping komisi, dan urutan posisinya." 
    backUrl="{{ route('dashboard.penatua.index') }}" 
/>

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-12 max-w-4xl overflow-hidden mb-12">
    <form action="{{ $type == 'Edit' ? route('dashboard.penatua.update', $penatua->id ?? 0) : route('dashboard.penatua.store') }}" method="POST">
        @csrf
        @if($type == 'Edit') @method('PUT') @endif
        
        <div class="grid grid-cols-2 gap-10">
            <div class="col-span-2">
                <x-form.input label="Nama Lengkap Penatua" name="nama" value="{{ old('nama', $penatua->nama ?? '') }}" placeholder="Contoh: Pnt. Alex R. Jacobus" />
            </div>

            <x-form.select label="Kategori Kepengurusan" name="kategori">
                <option value="Pengurus Harian" {{ old('kategori', $penatua->kategori ?? '') == 'Pengurus Harian' ? 'selected' : '' }}>Pengurus Harian</option>
                <option value="Bidang Kerja" {{ old('kategori', $penatua->kategori ?? '') == 'Bidang Kerja' ? 'selected' : '' }}>Bidang Kerja</option>
                <option value="Pendamping Komisi" {{ old('kategori', $penatua->kategori ?? '') == 'Pendamping Komisi' ? 'selected' : '' }}>Pendamping Komisi</option>
            </x-form.select>

            <x-form.select label="Jabatan Detail" name="jabatan">
                <option value="Ketua Umum" {{ old('jabatan', $penatua->jabatan ?? '') == 'Ketua Umum' ? 'selected' : '' }}>Ketua Umum</option>
                <option value="Wakil Ketua" {{ old('jabatan', $penatua->jabatan ?? '') == 'Wakil Ketua' ? 'selected' : '' }}>Wakil Ketua</option>
                <option value="Sekretaris 1" {{ old('jabatan', $penatua->jabatan ?? '') == 'Sekretaris 1' ? 'selected' : '' }}>Sekretaris 1</option>
                <option value="Sekretaris 2" {{ old('jabatan', $penatua->jabatan ?? '') == 'Sekretaris 2' ? 'selected' : '' }}>Sekretaris 2</option>
                <option value="Bendahara 1" {{ old('jabatan', $penatua->jabatan ?? '') == 'Bendahara 1' ? 'selected' : '' }}>Bendahara 1</option>
                <option value="Bendahara 2" {{ old('jabatan', $penatua->jabatan ?? '') == 'Bendahara 2' ? 'selected' : '' }}>Bendahara 2</option>
                <option value="Anggota" {{ old('jabatan', $penatua->jabatan ?? '') == 'Anggota' ? 'selected' : '' }}>Anggota</option>
                <option value="Pendamping" {{ old('jabatan', $penatua->jabatan ?? '') == 'Pendamping' ? 'selected' : '' }}>Pendamping</option>
            </x-form.select>

            <x-form.input label="Sub Kategori / Klasifikasi (Opsional)" name="sub_kategori" value="{{ old('sub_kategori', $penatua->sub_kategori ?? '') }}" placeholder="Contoh: Bid. Sarpen, Komisi Anak, Komisi Pemuda, dll." />

            <x-form.input label="Urutan Urut (Order Index)" name="urutan" type="number" value="{{ old('urutan', $penatua->urutan ?? 0) }}" placeholder="Contoh: 1, 2, 3..." />

            <div class="col-span-2 md:col-span-1">
                <x-form.select label="Status" name="status">
                    <option value="Aktif" {{ old('status', $penatua->status ?? '') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Tidak Aktif" {{ old('status', $penatua->status ?? '') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                </x-form.select>
            </div>

            <!-- Submit -->
            <div class="col-span-2 flex items-center gap-4 pt-8 border-t border-gray-50 mt-6">
                <button type="submit" class="px-10 py-4 bg-primary text-white rounded-2xl text-sm font-bold shadow-xl shadow-primary/20 hover:bg-blue-700 transition-all">
                    {{ $type == 'Tambah' ? 'Simpan Data' : 'Ubah Data' }}
                </button>
                <a href="{{ route('dashboard.penatua.index') }}" class="px-10 py-4 bg-gray-50 text-gray-400 rounded-2xl text-sm font-bold hover:bg-gray-100 transition-all text-center">
                    Batal
                </a>
            </div>
        </div>
    </form>
</div>
@endsection
