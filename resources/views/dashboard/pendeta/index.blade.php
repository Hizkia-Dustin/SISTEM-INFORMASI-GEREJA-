@extends('dashboard.layouts.app')
@section('title', 'Kelola Profil Pendeta')

@section('content')
<x-dashboard.page-header title="Daftar Profil Pendeta" subtitle="Kelola profil, riwayat pelayanan, visi, dan pendidikan pendeta gereja.">
    <a href="{{ route('dashboard.pendeta.create') }}" class="px-5 py-2.5 bg-primary text-white rounded-xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-blue-700 transition-all flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M12 4v16m8-8H4"/></svg>
        Tambah Profil Pendeta
    </a>
</x-dashboard.page-header>

<div class="grid grid-cols-1 gap-8 mb-12">
    @forelse($pendetas ?? [] as $p)
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8 flex flex-col lg:flex-row gap-8 items-start relative overflow-hidden">
        <div class="w-40 h-40 flex-shrink-0 rounded-2xl border border-gray-200 overflow-hidden relative bg-gray-50">
            @if($p->foto)
                <img src="{{ $p->foto }}" alt="{{ $p->nama }}" class="w-full h-full object-cover"/>
            @else
                <div class="w-full h-full flex items-center justify-center text-gray-300">
                    <span class="material-symbols-outlined text-5xl">person</span>
                </div>
            @endif
        </div>
        <div class="flex-grow flex flex-col gap-4">
            <div>
                <span class="px-3 py-1 bg-blue-50 text-primary rounded-full text-xs font-bold uppercase tracking-wider">{{ $p->status }}</span>
                <h3 class="font-heading text-2xl font-bold text-gray-800 mt-2">{{ $p->nama }}</h3>
                <p class="text-sm font-medium text-gray-400 mt-0.5">{{ $p->jabatan }}</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600 bg-gray-50/50 p-5 rounded-2xl border border-gray-100/50">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-lg">favorite</span>
                    <span><strong>Pasangan:</strong> {{ $p->pasangan ?? '-' }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-lg">mail</span>
                    <span><strong>Email:</strong> {{ $p->email ?? '-' }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-lg">calendar_today</span>
                    <span><strong>Jadwal Konseling:</strong> {{ $p->jadwal_konseling ?? '-' }}</span>
                </div>
            </div>

            @if($p->visi_pelayanan)
            <div class="text-sm text-gray-600">
                <h4 class="font-bold text-gray-800 mb-1">Visi Pelayanan:</h4>
                <p class="italic">"{{ $p->visi_pelayanan }}"</p>
            </div>
            @endif
        </div>
        <div class="flex lg:flex-col gap-2 shrink-0 self-stretch lg:self-start justify-end">
            <a href="{{ route('dashboard.pendeta.edit', $p->id) }}" class="px-5 py-2.5 rounded-xl bg-blue-50 text-primary text-xs font-bold hover:bg-blue-100 transition-all text-center">Edit</a>
            <form action="{{ route('dashboard.pendeta.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus profil pendeta ini?')">
                @csrf
                @method('DELETE')
                <button class="w-full px-5 py-2.5 rounded-xl bg-red-50 text-red-600 text-xs font-bold hover:bg-red-100 transition-all">Hapus</button>
            </form>
        </div>
    </div>
    @empty
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-12 text-center text-gray-400 italic">
        Belum ada profil pendeta terdaftar.
    </div>
    @endforelse
</div>
@endsection
