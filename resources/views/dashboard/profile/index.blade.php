@extends('dashboard.layouts.app')
@section('title', 'Profil Saya')

@section('content')
<x-dashboard.page-header title="Profil Admin" subtitle="Kelola informasi pribadi dan keamanan akun Anda." />

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden max-w-5xl">
    <div class="h-32 bg-primary relative">
        <div class="absolute -bottom-16 left-12 p-1.5 bg-white rounded-3xl shadow-lg shadow-primary/10">
            <div class="w-32 h-32 bg-gray-50 rounded-2xl flex items-center justify-center text-gray-200 border border-gray-50">
                <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12a5 5 0 100-10 5 5 0 000 10zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
            </div>
        </div>
    </div>
    
    <div class="pt-24 px-12 pb-12">
        <div class="flex items-center justify-between mb-12">
            <div>
                <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">Admin GKI Pakuwon</h2>
                <p class="text-sm text-gray-400 font-medium">Administrator Utama • Sektor 1</p>
            </div>
            <button class="px-6 py-2.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all">Ubah Profil</button>
        </div>

        <div class="grid grid-cols-2 gap-x-12 gap-y-8">
            <div class="flex flex-col gap-1">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Nomor Induk (NIK)</span>
                <span class="text-sm font-bold text-gray-700 tracking-widest">3273010101010001</span>
            </div>
            <div class="flex flex-col gap-1">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Username</span>
                <span class="text-sm font-bold text-gray-700">admin_pakuwon</span>
            </div>
            <div class="flex flex-col gap-1">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Jenis Kelamin</span>
                <span class="text-sm font-bold text-gray-700">Laki-laki</span>
            </div>
            <div class="flex flex-col gap-1">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Alamat</span>
                <span class="text-sm font-bold text-gray-700">Jl. Pakuwon Indah No. 1, Bandung</span>
            </div>
            <div class="flex flex-col gap-1">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status Anggota</span>
                <span class="text-sm font-bold text-emerald-600 uppercase">Aktif</span>
            </div>
            <div class="flex flex-col gap-1">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status Pernikahan</span>
                <span class="text-sm font-bold text-gray-700">Menikah</span>
            </div>
        </div>

        <div class="mt-12 pt-12 border-t border-gray-50 grid grid-cols-2 gap-12">
            <div class="flex flex-col gap-4">
                <h3 class="text-xs font-bold text-primary uppercase tracking-widest">Data Gerejawi</h3>
                <div class="flex flex-col gap-4">
                    <div class="flex items-center justify-between py-2 border-b border-gray-50">
                        <span class="text-xs text-gray-400 font-medium">Tanggal Baptis</span>
                        <span class="text-xs font-bold text-gray-700">12 Mei 1995</span>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-gray-50">
                        <span class="text-xs text-gray-400 font-medium">Tanggal Sidi</span>
                        <span class="text-xs font-bold text-gray-700">20 Jun 2010</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
