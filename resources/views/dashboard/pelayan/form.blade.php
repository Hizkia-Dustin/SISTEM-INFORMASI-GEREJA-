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

            <!-- Posisi -->
            <x-form.select label="Posisi / Jabatan" name="posisi">
                <option value="Pendeta" {{ (old('posisi', $pelayan->posisi ?? '') == 'Pendeta') ? 'selected' : '' }}>Pendeta</option>
                <option value="Penatua" {{ (old('posisi', $pelayan->posisi ?? '') == 'Penatua') ? 'selected' : '' }}>Penatua</option>
                <option value="Diaken" {{ (old('posisi', $pelayan->posisi ?? '') == 'Diaken') ? 'selected' : '' }}>Diaken</option>
                <option value="Penginjil" {{ (old('posisi', $pelayan->posisi ?? '') == 'Penginjil') ? 'selected' : '' }}>Penginjil</option>
            </x-form.select>

            <!-- Status -->
            <x-form.select label="Status" name="status">
                <option value="aktif" {{ (old('status', $pelayan->status ?? '') == 'aktif') ? 'selected' : '' }}>Aktif</option>
                <option value="tidak aktif" {{ (old('status', $pelayan->status ?? '') == 'tidak aktif') ? 'selected' : '' }}>Tidak Aktif</option>
            </x-form.select>

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
