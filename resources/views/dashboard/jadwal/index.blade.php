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
                <tr class="border-t border-gray-50">
                    <td class="px-8 py-5 font-bold text-gray-800">{{ $j->nama_acara }}</td>
                    <td class="px-8 py-5 text-gray-500">{{ $j->tanggal ? \Carbon\Carbon::parse($j->tanggal)->format('d/m/Y') : '-' }}</td>
                    <td class="px-8 py-5 text-gray-500">{{ $j->waktu_mulai }}</td>
                    <td class="px-8 py-5 text-gray-500">{{ $j->lokasi }}</td>
                    <td class="px-8 py-5 text-gray-500">{{ preg_match('/Jumlah hadir: ([0-9]+)/', $j->deskripsi ?? '', $match) ? $match[1] : '-' }}</td>
                    <td class="px-8 py-5 text-gray-500">-</td>
                    <td class="px-8 py-5">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('dashboard.jadwal.edit', $j->id) }}" class="px-3 py-2 rounded-lg bg-blue-50 text-primary text-xs font-bold">Edit</a>
                            <form action="{{ route('dashboard.jadwal.destroy', $j->id) }}" method="POST" onsubmit="return confirm('Hapus jadwal ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-2 rounded-lg bg-red-50 text-red-600 text-xs font-bold">Hapus</button>
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
