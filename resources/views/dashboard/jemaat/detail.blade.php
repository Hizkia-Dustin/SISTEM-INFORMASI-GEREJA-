@extends('dashboard.layouts.app')
@section('title', 'Detail Jemaat')

@section('content')
<x-dashboard.page-header 
    title="Detail Data Jemaat" 
    subtitle="Informasi lengkap riwayat jemaat dan status gerejawi." 
    backUrl="{{ route('dashboard.jemaat.index') }}" 
/>

<div class="grid grid-cols-3 gap-10">
    <!-- Profile Card -->
    <div class="col-span-1">
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="h-24 bg-primary"></div>
            <div class="px-8 pb-8">
                <div class="-mt-12 mb-6 flex justify-center">
                    <div class="w-24 h-24 bg-white rounded-2xl p-1 shadow-lg shadow-primary/10">
                        <div class="w-full h-full bg-blue-50 rounded-xl flex items-center justify-center text-primary font-bold text-2xl">
                            {{ substr($jemaat['nama'] ?? 'B', 0, 1) }}
                        </div>
                    </div>
                </div>
                <div class="text-center mb-8">
                    <h3 class="text-lg font-extrabold text-gray-800 tracking-tight">{{ $jemaat['nama'] ?? 'Budi Santoso' }}</h3>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-1">NIK: 3273010101010001</p>
                </div>
                <div class="flex flex-col gap-4">
                    <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 flex items-center justify-between">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status Anggota</span>
                        <span class="px-2 py-0.5 bg-emerald-50 text-emerald-600 text-[9px] font-extrabold rounded uppercase">Aktif</span>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 flex items-center justify-between">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Sektor</span>
                        <span class="text-xs font-bold text-gray-700">Sektor 1</span>
                    </div>
                </div>
                <div class="flex flex-col gap-3 mt-8">
                    <a href="{{ route('dashboard.jemaat.edit', 1) }}" class="w-full py-3.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all text-center">Ubah Profil</a>
                    <form action="{{ route('dashboard.jemaat.destroy', 1) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data jemaat ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full py-3.5 bg-rose-50 text-rose-500 rounded-xl text-sm font-bold hover:bg-rose-500 hover:text-white transition-all flex items-center justify-center gap-2">Hapus Jemaat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Tabs & Details -->
    <div class="col-span-2 flex flex-col gap-8">
        <!-- Tabs -->
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-10">
            <div class="flex items-center gap-8 mb-10 border-b border-gray-50">
                <button class="pb-4 px-2 text-xs font-extrabold text-primary border-b-2 border-primary uppercase tracking-widest">Data Pribadi</button>
                <button class="pb-4 px-2 text-xs font-extrabold text-gray-400 hover:text-gray-600 border-b-2 border-transparent uppercase tracking-widest transition-all">Data Gerejawi</button>
                <button class="pb-4 px-2 text-xs font-extrabold text-gray-400 hover:text-gray-600 border-b-2 border-transparent uppercase tracking-widest transition-all">Riwayat Pelayanan</button>
            </div>

            <div class="grid grid-cols-2 gap-x-12 gap-y-8">
                <div class="flex flex-col gap-1">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Tempat, Tanggal Lahir</span>
                    <span class="text-sm font-bold text-gray-700">Bandung, 12 Mei 1990</span>
                </div>
                <div class="flex flex-col gap-1">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Jenis Kelamin</span>
                    <span class="text-sm font-bold text-gray-700">Laki-laki</span>
                </div>
                <div class="flex flex-col gap-1">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Nomor Telepon</span>
                    <span class="text-sm font-bold text-gray-700">0812-3456-7890</span>
                </div>
                <div class="flex flex-col gap-1">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status Pernikahan</span>
                    <span class="text-sm font-bold text-gray-700">Menikah</span>
                </div>
                <div class="col-span-2 flex flex-col gap-1">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Alamat Lengkap</span>
                    <span class="text-sm font-bold text-gray-700">Perumahan Pakuwon Regency Blok A1 No. 5, Kota Bandung</span>
                </div>
            </div>
        </div>

        <!-- Church Info (Visible in another tab or below) -->
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-10">
            <h3 class="text-xs font-bold text-primary uppercase tracking-widest mb-8 flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                Status Gerejawi
            </h3>
            <div class="grid grid-cols-2 gap-10">
                <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Baptis</span>
                        <span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 text-[9px] font-extrabold rounded uppercase tracking-tighter">Sudah</span>
                    </div>
                    <p class="text-sm font-bold text-gray-700 mb-1">12 Mei 1995</p>
                    <p class="text-[10px] text-gray-400 font-medium italic">Oleh: Pdt. Markus Santoso</p>
                    <button class="mt-4 flex items-center gap-2 text-primary text-[10px] font-extrabold uppercase hover:underline">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        Lihat Surat Baptis
                    </button>
                </div>
                <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Sidi</span>
                        <span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 text-[9px] font-extrabold rounded uppercase tracking-tighter">Sudah</span>
                    </div>
                    <p class="text-sm font-bold text-gray-700 mb-1">20 Jun 2010</p>
                    <p class="text-[10px] text-gray-400 font-medium italic">Oleh: Pdt. Maria Ulfa</p>
                    <button class="mt-4 flex items-center gap-2 text-primary text-[10px] font-extrabold uppercase hover:underline">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        Lihat Surat Sidi
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
