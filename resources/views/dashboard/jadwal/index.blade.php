@extends('dashboard.layouts.app')
@section('title', 'Jadwal Ibadah')

@section('content')
<x-dashboard.page-header title="Daftar Jadwal Ibadah" subtitle="Kelola jadwal kebaktian rutin dan khusus GKI Pakuwon.">
    <a href="{{ route('dashboard.jadwal.create') }}" class="px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M12 4v16m8-8H4"/></svg>
        Tambah Jadwal Ibadah
    </a>
</x-dashboard.page-header>

<!-- Jadwal Table -->
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-12">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                <tr>
                    <th class="px-8 py-4">Nama Ibadah</th>
                    <th class="px-8 py-4">Tanggal</th>
                    <th class="px-8 py-4">Waktu</th>
                    <th class="px-8 py-4">Jenis Ibadah</th>
                    <th class="px-8 py-4">Jumlah Hadir</th>
                    <th class="px-8 py-4">Tata Ibadah</th>
                    <th class="px-8 py-4 text-right">Pilihan</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($jadwal ?? [] as $j)
                <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                    <td class="px-8 py-4 font-bold text-gray-800">{{ $j->nama }}</td>
                    <td class="px-8 py-4 text-gray-600">{{ \Carbon\Carbon::parse($j->tanggal)->format('d M Y') }}</td>
                    <td class="px-8 py-4 text-gray-600">{{ \Carbon\Carbon::parse($j->waktu)->format('H:i') }}</td>
                    <td class="px-8 py-4 text-gray-600">
                        <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-[10px] font-bold tracking-widest uppercase">{{ $j->jenis }}</span>
                    </td>
                    <td class="px-8 py-4 text-gray-600">{{ $j->jumlah_hadir ?? '-' }}</td>
                    <td class="px-8 py-4">
                        @if($j->lampiran)
                            <a href="{{ asset('storage/' . $j->lampiran) }}" target="_blank" class="text-primary hover:underline text-xs font-bold flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                Lihat File
                            </a>
                        @else
                            <span class="text-gray-400 text-xs italic">Tidak ada</span>
                        @endif
                    </td>
                    <td class="px-8 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('dashboard.jadwal.edit', $j->id) }}" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form class="confirm-delete" action="{{ route('dashboard.jadwal.destroy', $j->id) }}" method="POST" data-confirm="Apakah Anda yakin ingin menghapus data ini?">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-8 py-12 text-center text-gray-400 italic">Belum ada jadwal ibadah terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
