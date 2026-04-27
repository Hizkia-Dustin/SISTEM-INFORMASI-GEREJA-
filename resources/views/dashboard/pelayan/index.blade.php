@extends('dashboard.layouts.app')
@section('title', 'Pelayan Jemaat')

@section('content')
<x-dashboard.page-header title="Daftar Pelayan Gereja" subtitle="Daftar Pendeta, Penatua, dan Diaken yang aktif melayani.">
    <a href="{{ route('dashboard.pelayan.create') }}" class="px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M12 4v16m8-8H4"/></svg>
        Tambah Pelayan
    </a>
</x-dashboard.page-header>

<!-- Pelayan Table -->
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-12">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                <tr>
                    <th class="px-8 py-4">NIK</th>
                    <th class="px-8 py-4">Nama</th>
                    <th class="px-8 py-4">Peran</th>
                    <th class="px-8 py-4">Terima Jabatan</th>
                    <th class="px-8 py-4">Akhir Jabatan</th>
                    <th class="px-8 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                <tr>
                    <td colspan="6" class="px-8 py-12 text-center text-gray-400 italic">Belum ada data pelayan terdaftar.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
