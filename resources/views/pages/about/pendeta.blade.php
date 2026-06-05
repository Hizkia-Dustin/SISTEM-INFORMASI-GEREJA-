<x-layouts.main title="Profil Pendeta" :fullWidth="true">
<div class="max-w-[1440px] mx-auto px-8 py-8">
@if($pendeta)
<div class="bento-grid">
<section class="col-span-12 lg:col-span-8 flex flex-col gap-6">
<div class="glass-card rounded-2xl p-8 flex flex-col md:flex-row gap-8 items-center md:items-start relative overflow-hidden">
<div class="absolute top-0 right-0 w-64 h-64 bg-primary/5 rounded-full -mr-32 -mt-32"></div>
<div class="w-48 h-48 flex-shrink-0 rounded-2xl border-4 border-white shadow-lg overflow-hidden relative z-10">
<img alt="{{ $pendeta->nama }}" class="w-full h-full object-cover" src="{{ $pendeta->foto ?? 'https://via.placeholder.com/150' }}"/>
</div>
<div class="flex flex-col gap-2 relative z-10">
<span class="font-label-md text-secondary tracking-widest uppercase">Profil Pendeta</span>
<h1 class="font-h1 text-h1 text-primary mb-1">{{ $pendeta->nama }}</h1>
<p class="font-h3 text-h3 text-gray-600">{{ $pendeta->jabatan }}</p>
<div class="flex flex-wrap gap-4 mt-4">
@if($pendeta->pasangan)
<div class="flex items-center gap-1 px-4 py-2 bg-surface-container rounded-xl">
<span class="material-symbols-outlined text-primary" data-icon="favorite">favorite</span>
<span class="font-label-md">{{ $pendeta->pasangan }}</span>
</div>
@endif
@if($pendeta->email)
<div class="flex items-center gap-1 px-4 py-2 bg-surface-container rounded-xl">
<span class="material-symbols-outlined text-primary" data-icon="mail">mail</span>
<span class="font-label-md">{{ $pendeta->email }}</span>
</div>
@endif
</div>
</div>
</div>
<div class="glass-card rounded-xl p-8 flex flex-col gap-6">
<div class="flex items-center gap-4 border-b border-outline-variant pb-4">
<span class="material-symbols-outlined text-primary text-3xl" data-icon="history_edu">history_edu</span>
<h2 class="font-h2 text-h2 text-primary">Riwayat Pelayanan</h2>
</div>
<div class="relative">
<div class="absolute left-4 top-2 bottom-2 w-0.5 bg-surface-container-high"></div>
<div class="flex flex-col gap-8">
@if(!empty($pendeta->riwayat_pelayanan) && is_array($pendeta->riwayat_pelayanan))
    @foreach($pendeta->riwayat_pelayanan as $r)
    <div class="relative pl-12">
        @if($loop->last)
        <div class="absolute left-1.5 top-0 w-5 h-5 bg-primary rounded-full flex items-center justify-center border-4 border-white shadow-md">
            <div class="w-1.5 h-1.5 bg-white rounded-full"></div>
        </div>
        <div class="font-label-sm text-primary mb-1">{{ $r['tanggal'] ?? '' }}</div>
        <h3 class="font-h3 text-h3 text-primary font-bold">{{ $r['judul'] ?? '' }}</h3>
        <p class="text-gray-600 mt-1">{{ $r['deskripsi'] ?? '' }}</p>
        @else
        <div class="absolute left-2.5 top-1.5 w-3 h-3 bg-secondary rounded-full border-2 border-white ring-4 ring-secondary/20"></div>
        <div class="font-label-sm text-secondary mb-1">{{ $r['tanggal'] ?? '' }}</div>
        <h3 class="font-h3 text-h3 text-primary">{{ $r['judul'] ?? '' }}</h3>
        <p class="text-gray-600 mt-1">{{ $r['deskripsi'] ?? '' }}</p>
        @endif
    </div>
    @endforeach
@else
    <p class="text-gray-400 italic text-sm pl-12">Belum ada riwayat pelayanan terdaftar.</p>
@endif
</div>
</div>
</div>
</section>
<aside class="col-span-12 lg:col-span-4 flex flex-col gap-6">
<div class="glass-card rounded-xl p-8 flex flex-col gap-6 border-l-4 border-l-secondary">
<div class="flex items-center gap-4">
<span class="material-symbols-outlined text-primary text-3xl" data-icon="school">school</span>
<h2 class="font-h2 text-h2 text-primary">Pendidikan</h2>
</div>
<div class="flex flex-col gap-8">
@if(!empty($pendeta->pendidikan) && is_array($pendeta->pendidikan))
    @foreach($pendeta->pendidikan as $edu)
    <div class="flex flex-col gap-1">
        <span class="font-label-sm text-secondary px-2 py-0.5 bg-secondary/10 rounded-md self-start">{{ $edu['tahun'] ?? '' }}</span>
        <h3 class="font-label-md text-primary">{{ $edu['gelar'] ?? '' }}</h3>
        <p class="text-gray-600 leading-relaxed">{{ $edu['institusi'] ?? '' }}</p>
    </div>
    @endforeach
@else
    <p class="text-gray-400 italic text-sm">Belum ada riwayat pendidikan terdaftar.</p>
@endif
</div>
</div>
<div class="bg-primary rounded-xl p-8 text-white relative overflow-hidden group">
<div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
<div class="grid grid-cols-6 gap-2 rotate-12 -translate-x-10 -translate-y-10">
<div class="h-12 w-12 bg-white rounded-full"></div>
<div class="h-12 w-12 bg-white rounded-full"></div>
<div class="h-12 w-12 bg-white rounded-full"></div>
<div class="h-12 w-12 bg-white rounded-full"></div>
<div class="h-12 w-12 bg-white rounded-full"></div>
</div>
</div>
<h3 class="font-h3 text-h3 mb-4 relative z-10">Visi Pelayanan</h3>
<p class="font-body-lg text-body-lg text-blue-100 relative z-10 italic">
    "{{ $pendeta->visi_pelayanan ?? '-' }}"
</p>
<div class="mt-8 pt-6 border-t border-white/10 flex justify-between items-center relative z-10">
<div class="flex flex-col">
<span class="font-label-sm uppercase opacity-60">Status</span>
<span class="font-label-md">{{ $pendeta->status ?? 'Aktif Melayani' }}</span>
</div>
<span class="material-symbols-outlined text-4xl text-blue-100 opacity-40" data-icon="church">church</span>
</div>
</div>
@if($pendeta->jadwal_konseling)
<div class="glass-card rounded-xl p-4">
<div class="flex items-center gap-4 p-4 bg-surface-container rounded-lg">
<div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white">
<span class="material-symbols-outlined" data-icon="calendar_today">calendar_today</span>
</div>
<div class="flex flex-col">
<span class="font-label-sm text-gray-600">Jadwal Konseling</span>
<span class="font-label-md text-primary">{{ $pendeta->jadwal_konseling }}</span>
</div>
</div>
</div>
@endif
</aside>
</div>
@else
<div class="glass-card rounded-2xl p-12 text-center text-gray-500 italic max-w-2xl mx-auto">
    Profil pendeta belum dikonfigurasi di dashboard admin.
</div>
@endif
</div>
</x-layouts.main>
