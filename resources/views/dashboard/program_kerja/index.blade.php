@extends('dashboard.layouts.app')
@section('title', 'Program Kerja')

@section('content')
<x-dashboard.page-header title="Program Kerja & RAPB" subtitle="Arsip rancangan program kerja dan anggaran jemaat GKI Pakuwon.">
    <a href="{{ route('dashboard.program_kerja.create') }}" class="px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M12 4v16m8-8H4"/></svg>
        Tambah Program
    </a>
</x-dashboard.page-header>

<div class="grid grid-cols-2 gap-8">
    <!-- Rancangan Program Kerja Column -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-8 py-5 border-b border-gray-50 bg-gray-50/30 flex items-center justify-between">
            <h3 class="text-xs font-bold text-gray-700 uppercase tracking-widest">Rancangan Program Kerja</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                    <tr>
                        <th class="px-8 py-4">Tahun</th>
                        <th class="px-8 py-4 text-center">Lampiran</th>
                        <th class="px-8 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @php $rancangan = $program->where('jenis', 'Rancangan Program Kerja'); @endphp
                    @forelse($rancangan as $item)
                    <tr class="border-b border-gray-50 hover:bg-gray-50/30 transition-colors">
                        <td class="px-8 py-5 font-extrabold text-gray-700">{{ $item->tahun }}</td>
                        <td class="px-8 py-5 text-center">
                            @if($item->lampiran)
                            <a href="{{ asset('storage/' . $item->lampiran) }}" target="_blank" class="text-primary font-bold text-xs hover:underline inline-flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                Lihat File
                            </a>
                            @else
                            <span class="text-gray-400 italic text-xs">Tidak ada file</span>
                            @endif
                        </td>
                        <td class="px-8 py-5 text-right">
                            <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('dashboard.program_kerja.edit', $item->id) }}" class="px-4 py-2 bg-primary text-white rounded-lg text-xs font-bold shadow-lg shadow-primary/10 hover:bg-blue-700 transition-all">Ubah</a>
                            <form class="confirm-delete" action="{{ route('dashboard.program_kerja.destroy', $item->id) }}" method="POST" data-confirm="Apakah Anda yakin ingin menghapus data ini?">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-rose-50 text-rose-500 rounded-lg text-xs font-bold hover:bg-rose-500 hover:text-white transition-all">Hapus</button>
                            </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-8 py-12 text-center text-gray-400 italic">Belum ada data program kerja.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- RAPB Column -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-8 py-5 border-b border-gray-50 bg-gray-50/30 flex items-center justify-between">
            <h3 class="text-xs font-bold text-gray-700 uppercase tracking-widest">Daftar RAPB</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                    <tr>
                        <th class="px-8 py-4">Tahun</th>
                        <th class="px-8 py-4 text-center">Lampiran</th>
                        <th class="px-8 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @php $rapb = $program->where('jenis', 'RAPB'); @endphp
                    @forelse($rapb as $item)
                    <tr class="border-b border-gray-50 hover:bg-gray-50/30 transition-colors">
                        <td class="px-8 py-5 font-extrabold text-gray-700">{{ $item->tahun }}</td>
                        <td class="px-8 py-5 text-center">
                            @if($item->lampiran)
                            <a href="{{ asset('storage/' . $item->lampiran) }}" target="_blank" class="text-primary font-bold text-xs hover:underline inline-flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                Lihat File
                            </a>
                            @else
                            <span class="text-gray-400 italic text-xs">Tidak ada file</span>
                            @endif
                        </td>
                        <td class="px-8 py-5 text-right">
                            <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('dashboard.program_kerja.edit', $item->id) }}" class="px-4 py-2 bg-primary text-white rounded-lg text-xs font-bold shadow-lg shadow-primary/10 hover:bg-blue-700 transition-all">Ubah</a>
                            <form class="confirm-delete" action="{{ route('dashboard.program_kerja.destroy', $item->id) }}" method="POST" data-confirm="Apakah Anda yakin ingin menghapus data ini?">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-rose-50 text-rose-500 rounded-lg text-xs font-bold hover:bg-rose-500 hover:text-white transition-all">Hapus</button>
                            </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-8 py-12 text-center text-gray-400 italic">Belum ada data RAPB.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
