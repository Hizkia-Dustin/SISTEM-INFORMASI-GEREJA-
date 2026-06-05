@extends('dashboard.layouts.app')
@section('title', 'Kelola Majelis Penatua')

@section('content')
<x-dashboard.page-header title="Daftar Susunan Penatua" subtitle="Kelola keanggotaan majelis jemaat Penatua Pakuwon.">
    <a href="{{ route('dashboard.penatua.create') }}" class="px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M12 4v16m8-8H4"/></svg>
        Tambah Anggota Penatua
    </a>
</x-dashboard.page-header>

<!-- Alert Success -->
@if(session('success'))
<div class="mb-6 p-4 bg-emerald-50 text-emerald-700 rounded-2xl border border-emerald-100 text-sm font-bold">
    {{ session('success') }}
</div>
@endif

@php
    $pengurus = $penatuas->where('kategori', 'Pengurus Harian');
    $bidang = $penatuas->where('kategori', 'Bidang Kerja');
    $pendamping = $penatuas->where('kategori', 'Pendamping Komisi');
@endphp

<!-- 1. Pengurus Harian -->
<div class="mb-12">
    <div class="flex items-center gap-4 mb-6">
        <h3 class="font-heading text-xl font-bold text-gray-800">Pengurus Harian</h3>
        <div class="h-[1px] flex-grow bg-gray-100"></div>
    </div>
    
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">
                    <th class="px-8 py-4">Nama Lengkap</th>
                    <th class="px-8 py-4">Jabatan</th>
                    <th class="px-8 py-4">Urutan</th>
                    <th class="px-8 py-4">Status</th>
                    <th class="px-8 py-4 text-right">Pilihan</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-50">
                @forelse($pengurus as $p)
                <tr>
                    <td class="px-8 py-5 font-bold text-gray-800">{{ $p->nama }}</td>
                    <td class="px-8 py-5 text-gray-500">{{ $p->jabatan }}</td>
                    <td class="px-8 py-5 text-gray-400">#{{ $p->urutan }}</td>
                    <td class="px-8 py-5">
                        <span class="px-2.5 py-0.5 bg-emerald-50 text-emerald-700 border border-emerald-100 text-[10px] font-bold uppercase rounded">{{ $p->status }}</span>
                    </td>
                    <td class="px-8 py-5">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('dashboard.penatua.edit', $p->id) }}" class="px-3 py-2 rounded-lg bg-blue-50 text-primary text-xs font-bold hover:bg-blue-100 transition-all">Edit</a>
                            <form action="{{ route('dashboard.penatua.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus penatua ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-2 rounded-lg bg-red-50 text-red-600 text-xs font-bold hover:bg-red-100 transition-all">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-10 text-center text-gray-400 italic">Belum ada pengurus harian.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- 2. Bidang Kerja -->
<div class="mb-12">
    <div class="flex items-center gap-4 mb-6">
        <h3 class="font-heading text-xl font-bold text-gray-800">Bidang Kerja</h3>
        <div class="h-[1px] flex-grow bg-gray-100"></div>
    </div>
    
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">
                    <th class="px-8 py-4">Nama Lengkap</th>
                    <th class="px-8 py-4">Bidang</th>
                    <th class="px-8 py-4">Jabatan</th>
                    <th class="px-8 py-4">Urutan</th>
                    <th class="px-8 py-4">Status</th>
                    <th class="px-8 py-4 text-right">Pilihan</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-50">
                @forelse($bidang as $p)
                <tr>
                    <td class="px-8 py-5 font-bold text-gray-800">{{ $p->nama }}</td>
                    <td class="px-8 py-5 text-gray-500">
                        <span class="px-2.5 py-0.5 bg-blue-50 text-primary border border-blue-100 text-xs font-semibold rounded">{{ $p->sub_kategori }}</span>
                    </td>
                    <td class="px-8 py-5 text-gray-500">{{ $p->jabatan }}</td>
                    <td class="px-8 py-5 text-gray-400">#{{ $p->urutan }}</td>
                    <td class="px-8 py-5">
                        <span class="px-2.5 py-0.5 bg-emerald-50 text-emerald-700 border border-emerald-100 text-[10px] font-bold uppercase rounded">{{ $p->status }}</span>
                    </td>
                    <td class="px-8 py-5">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('dashboard.penatua.edit', $p->id) }}" class="px-3 py-2 rounded-lg bg-blue-50 text-primary text-xs font-bold hover:bg-blue-100 transition-all">Edit</a>
                            <form action="{{ route('dashboard.penatua.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus penatua ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-2 rounded-lg bg-red-50 text-red-600 text-xs font-bold hover:bg-red-100 transition-all">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-8 py-10 text-center text-gray-400 italic">Belum ada bidang kerja.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- 3. Pendamping Komisi -->
<div class="mb-12">
    <div class="flex items-center gap-4 mb-6">
        <h3 class="font-heading text-xl font-bold text-gray-800">Pendamping Komisi / Kategorial</h3>
        <div class="h-[1px] flex-grow bg-gray-100"></div>
    </div>
    
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">
                    <th class="px-8 py-4">Nama Lengkap</th>
                    <th class="px-8 py-4">Komisi / Kategorial</th>
                    <th class="px-8 py-4">Urutan</th>
                    <th class="px-8 py-4">Status</th>
                    <th class="px-8 py-4 text-right">Pilihan</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-50">
                @forelse($pendamping as $p)
                <tr>
                    <td class="px-8 py-5 font-bold text-gray-800">{{ $p->nama }}</td>
                    <td class="px-8 py-5 text-gray-500">
                        <span class="px-2.5 py-0.5 bg-indigo-50 text-indigo-700 border border-indigo-100 text-xs font-semibold rounded">{{ $p->sub_kategori }}</span>
                    </td>
                    <td class="px-8 py-5 text-gray-400">#{{ $p->urutan }}</td>
                    <td class="px-8 py-5">
                        <span class="px-2.5 py-0.5 bg-emerald-50 text-emerald-700 border border-emerald-100 text-[10px] font-bold uppercase rounded">{{ $p->status }}</span>
                    </td>
                    <td class="px-8 py-5">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('dashboard.penatua.edit', $p->id) }}" class="px-3 py-2 rounded-lg bg-blue-50 text-primary text-xs font-bold hover:bg-blue-100 transition-all">Edit</a>
                            <form action="{{ route('dashboard.penatua.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus penatua ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-2 rounded-lg bg-red-50 text-red-600 text-xs font-bold hover:bg-red-100 transition-all">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-10 text-center text-gray-400 italic">Belum ada pendamping komisi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
