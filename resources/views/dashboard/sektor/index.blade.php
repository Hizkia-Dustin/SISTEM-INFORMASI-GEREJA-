@extends('dashboard.layouts.app')
@section('title', 'Data Sektor')

@section('content')
<div x-data="{ tab: new URLSearchParams(window.location.search).get('tab') || 'anggota' }">
    <x-dashboard.page-header title="Sektor & Wilayah" subtitle="Pembagian wilayah pelayanan jemaat GKI Pakuwon.">
        <a href="{{ route('dashboard.sektor.create') }}" class="px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M12 4v16m8-8H4"/></svg>
            Tambah Sektor
        </a>
    </x-dashboard.page-header>

    <!-- Tabs -->
    <div class="flex items-center gap-8 mb-8 border-b border-gray-100">
        <button @click="tab = 'anggota'" :class="tab === 'anggota' ? 'pb-4 px-2 text-sm font-bold text-primary border-b-2 border-primary' : 'pb-4 px-2 text-sm font-bold text-gray-400 hover:text-gray-600 border-b-2 border-transparent transition-all'">Anggota Sektor</button>
        <button @click="tab = 'master'" :class="tab === 'master' ? 'pb-4 px-2 text-sm font-bold text-primary border-b-2 border-primary' : 'pb-4 px-2 text-sm font-bold text-gray-400 hover:text-gray-600 border-b-2 border-transparent transition-all'">Data Master Sektor</button>
    </div>

    <div x-show="tab === 'anggota'">
        <!-- Sektor Selector -->
        <div class="mb-10">
            <label class="block mb-3 font-bold text-gray-400 text-[10px] uppercase tracking-widest">Pilih Sektor</label>
            <form action="{{ route('dashboard.sektor.index') }}" method="GET" id="sektorForm">
                <input type="hidden" name="tab" value="anggota">
                <select name="sektor_id" onchange="document.getElementById('sektorForm').submit()" class="w-64 bg-white border border-gray-100 rounded-xl py-2.5 px-4 text-xs font-bold text-gray-600 focus:ring-2 focus:ring-primary/10 transition-all shadow-sm">
                    <option value="">-- Pilih Sektor --</option>
                    @foreach($sektors as $s)
                        <option value="{{ $s->id }}" {{ $selectedSektorId == $s->id ? 'selected' : '' }}>{{ $s->nama }}</option>
                    @endforeach
                </select>
            </form>
        </div>

        @if($selectedSektorId)
            <!-- Anggota Table -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-12">
                <div class="px-8 py-5 border-b border-gray-50 bg-gray-50/30">
                    <h3 class="text-sm font-bold text-gray-700 uppercase tracking-widest">Daftar Anggota Jemaat</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                            <tr>
                                <th class="px-8 py-4">Nama Lengkap</th>
                                <th class="px-8 py-4">Status</th>
                                <th class="px-8 py-4">Keluarga</th>
                                <th class="px-8 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @forelse($anggotaJemaat as $anggota)
                            <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                                <td class="px-8 py-4 font-bold text-gray-700">{{ $anggota->nama_lengkap }}</td>
                                <td class="px-8 py-4">
                                    <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-bold rounded-full uppercase">{{ $anggota->status_keanggotaan ?? 'Aktif' }}</span>
                                </td>
                                <td class="px-8 py-4 text-gray-500">{{ $anggota->keluarga->nama_kepala_keluarga ?? '-' }}</td>
                                <td class="px-8 py-4 text-right">
                                    <a href="{{ route('dashboard.jemaat.show', $anggota->id) }}" class="text-primary hover:text-blue-700 font-bold text-xs">Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-8 py-12 text-center text-gray-400 italic">Belum ada data anggota jemaat di sektor ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="px-8 py-12 text-center text-gray-400 italic bg-white rounded-2xl border border-gray-100 shadow-sm">Silakan pilih sektor terlebih dahulu untuk melihat daftar anggota.</div>
        @endif
    </div>

    <div x-show="tab === 'master'" x-cloak>
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-8 py-5 border-b border-gray-50 bg-gray-50/30 flex justify-between items-center">
                <h3 class="text-sm font-bold text-gray-700 uppercase tracking-widest">Daftar Sektor</h3>
                <span class="text-[10px] font-bold text-primary bg-white px-3 py-1 rounded-full uppercase border border-blue-100 shadow-sm">Master Data</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                        <tr>
                            <th class="px-8 py-4">No</th>
                            <th class="px-8 py-4">Nama Sektor</th>
                            <th class="px-8 py-4">Keterangan</th>
                            <th class="px-8 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($sektors as $i => $s)
                        <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                            <td class="px-8 py-4 text-gray-500">{{ $i + 1 }}</td>
                            <td class="px-8 py-4 font-bold text-gray-700">{{ $s->nama }}</td>
                            <td class="px-8 py-4 text-gray-500">{{ $s->keterangan }}</td>
                            <td class="px-8 py-4 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('dashboard.sektor.edit', $s->id) }}" class="text-gray-400 hover:text-primary transition-colors text-xs font-bold">Edit</a>
                                    <form action="{{ route('dashboard.sektor.destroy', $s->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus sektor ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-600 transition-colors text-xs font-bold">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-12 text-center text-gray-400 italic">Belum ada data sektor.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
