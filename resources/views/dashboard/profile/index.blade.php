@extends('dashboard.layouts.app')
@section('title', 'Profil Saya')

@section('content')
<x-dashboard.page-header title="Profil Admin" subtitle="Kelola informasi pribadi dan keamanan akun Anda." />

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden max-w-5xl">
    <div class="h-32 bg-primary relative">
        <div class="absolute -bottom-16 left-12 p-1.5 bg-white rounded-3xl shadow-lg shadow-primary/10">
            <div class="w-32 h-32 bg-gray-50 rounded-2xl flex items-center justify-center text-gray-200 border border-gray-50">
                @if(!empty($user->foto_profil))
                    <img src="{{ asset('storage/' . $user->foto_profil) }}" class="w-full h-full object-cover rounded-xl" alt="Foto Profil">
                @else
                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12a5 5 0 100-10 5 5 0 000 10zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                @endif
            </div>
        </div>
    </div>
    
    <div class="pt-24 px-12 pb-12">
        <div class="flex items-center justify-between mb-12">
            <div>
                <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">{{ $user->name ?? 'Admin GKI' }}</h2>
                <p class="text-sm text-gray-400 font-medium">{{ $user->role ?? 'Administrator' }} • Sektor {{ $user->sektor ?? '-' }}</p>
            </div>
            <a href="{{ route('dashboard.profil.edit') }}" class="px-6 py-2.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all inline-block">Ubah Profil</a>
        </div>

        <div class="grid grid-cols-2 gap-x-12 gap-y-8">
            <div class="flex flex-col gap-1">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Nomor Induk (NIK)</span>
                <span class="text-sm font-bold text-gray-700 tracking-widest">{{ $user->no_induk ?? '-' }}</span>
            </div>
            <div class="flex flex-col gap-1">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Username</span>
                <span class="text-sm font-bold text-gray-700">{{ $user->username ?? '-' }}</span>
            </div>
            <div class="flex flex-col gap-1">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Email</span>
                <span class="text-sm font-bold text-gray-700">{{ $user->email ?? '-' }}</span>
            </div>
            <div class="flex flex-col gap-1">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Jenis Kelamin</span>
                <span class="text-sm font-bold text-gray-700">{{ $user->jenis_kelamin ?? '-' }}</span>
            </div>
            <div class="flex flex-col gap-1">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Alamat</span>
                <span class="text-sm font-bold text-gray-700">{{ $user->alamat ?? '-' }}</span>
            </div>
            <div class="flex flex-col gap-1">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status Anggota</span>
                <span class="text-sm font-bold text-emerald-600 uppercase">{{ $user->status_anggota ?? '-' }}</span>
            </div>
            <div class="flex flex-col gap-1">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status Pernikahan</span>
                <span class="text-sm font-bold text-gray-700">{{ $user->status_pernikahan ?? '-' }}</span>
            </div>
        </div>

        <div class="mt-12 pt-12 border-t border-gray-50 grid grid-cols-2 gap-12">
            <div class="flex flex-col gap-4">
                <h3 class="text-xs font-bold text-primary uppercase tracking-widest">Data Gerejawi</h3>
                <div class="flex flex-col gap-4">
                    <div class="flex items-center justify-between py-2 border-b border-gray-50">
                        <span class="text-xs text-gray-400 font-medium">Tanggal Baptis</span>
                        <span class="text-xs font-bold text-gray-700">{{ $user->tanggal_baptis ? \Carbon\Carbon::parse($user->tanggal_baptis)->format('d M Y') : '-' }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-gray-50">
                        <span class="text-xs text-gray-400 font-medium">Tanggal Sidi</span>
                        <span class="text-xs font-bold text-gray-700">{{ $user->tanggal_sidi ? \Carbon\Carbon::parse($user->tanggal_sidi)->format('d M Y') : '-' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
