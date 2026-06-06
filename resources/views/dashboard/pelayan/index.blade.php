@extends('dashboard.layouts.app')
@section('title', 'Pelayan Jemaat')

@section('content')
<x-dashboard.page-header title="Daftar Pelayan Gereja" subtitle="Kelola data pelayan dan pendaftaran pelayanan dari jemaat.">
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
                    <th class="px-8 py-4">Nama</th>
                    <th class="px-8 py-4">Posisi</th>
                    <th class="px-8 py-4">Komisi</th>
                    <th class="px-8 py-4">Kontak</th>
                    <th class="px-8 py-4">Tanggal Mulai</th>
                    <th class="px-8 py-4">Status</th>
                    <th class="px-8 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($pelayan as $p)
                <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                    <td class="px-8 py-4 font-bold text-gray-800">{{ $p->nama }}</td>
                    <td class="px-8 py-4 text-gray-600">
                        <p class="font-bold">{{ $p->posisi }}</p>
                        @if(!empty($p->alasan))
                            <p class="text-xs text-gray-400 mt-1 max-w-xs">{{ \Illuminate\Support\Str::limit($p->alasan, 80) }}</p>
                        @endif
                    </td>
                    <td class="px-8 py-4 text-gray-600">{{ $p->komisi_tujuan ?? $p->kelompok_layanan ?? '-' }}</td>
                    <td class="px-8 py-4 text-gray-600">
                        <p>{{ $p->no_telepon ?? $p->email ?? '-' }}</p>
                        <p class="text-xs text-gray-400">{{ $p->email ?? '-' }}</p>
                    </td>
                    <td class="px-8 py-4 text-gray-600">{{ \Carbon\Carbon::parse($p->tanggal_mulai)->format('d M Y') }}</td>
                    <td class="px-8 py-4">
                        @if(strtolower($p->status) == 'aktif')
                            <span class="px-3 py-1 bg-green-50 text-green-600 rounded-full text-xs font-bold">Aktif</span>
                        @elseif(strtolower($p->status) == 'pending')
                            <span class="px-3 py-1 bg-amber-50 text-amber-600 rounded-full text-xs font-bold">Menunggu</span>
                        @elseif(strtolower($p->status) == 'ditolak')
                            <span class="px-3 py-1 bg-red-50 text-red-600 rounded-full text-xs font-bold">Ditolak</span>
                        @else
                            <span class="px-3 py-1 bg-red-50 text-red-600 rounded-full text-xs font-bold">Tidak Aktif</span>
                        @endif
                    </td>
                    <td class="px-8 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            @if(strtolower($p->status) == 'pending')
                                <form action="{{ route('dashboard.pelayan.approve', $p->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="px-3 py-2 bg-green-50 text-green-600 rounded-lg hover:bg-green-100 transition-colors text-xs font-bold">Approve</button>
                                </form>
                                <form action="{{ route('dashboard.pelayan.reject', $p->id) }}" method="POST" onsubmit="return confirm('Tolak pendaftaran pelayanan ini?');">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="px-3 py-2 bg-amber-50 text-amber-600 rounded-lg hover:bg-amber-100 transition-colors text-xs font-bold">Tolak</button>
                                </form>
                            @endif
                            <a href="{{ route('dashboard.pelayan.edit', $p->id) }}" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form class="confirm-delete" action="{{ route('dashboard.pelayan.destroy', $p->id) }}" method="POST" data-confirm="Apakah Anda yakin ingin menghapus data ini?">
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
                    <td colspan="7" class="px-8 py-12 text-center text-gray-400 italic">Belum ada data pelayan terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
