@props(['title' => 'Belum Ada Konten', 'icon' => 'edit_document'])

<div class="bg-surface-container rounded-[2rem] p-8 md:p-16 text-center flex flex-col items-center justify-center border-2 border-dashed border-outline-variant/50 max-w-4xl mx-auto my-12">
    <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mb-6 shadow-sm">
        <span class="material-symbols-outlined text-secondary text-5xl">{{ $icon }}</span>
    </div>
    <h2 class="font-h1 text-h1 text-primary-container mb-4">{{ $title }}</h2>
    <div class="font-body-lg text-on-surface-variant max-w-2xl mx-auto leading-relaxed mb-8">
        {{ $slot }}
    </div>
    <div class="flex flex-col sm:flex-row gap-4">
        <a href="{{ route('home') }}" class="px-6 py-3 bg-primary-container text-white rounded-full font-label-md hover:bg-primary transition-colors flex items-center justify-center gap-2">
            <span class="material-symbols-outlined text-[20px]">home</span>
            Kembali ke Beranda
        </a>
        <a href="{{ route('warta.index') }}" class="px-6 py-3 bg-white border border-outline-variant text-primary-container rounded-full font-label-md hover:bg-surface-container-low transition-colors flex items-center justify-center gap-2">
            <span class="material-symbols-outlined text-[20px]">newspaper</span>
            Baca Warta Jemaat
        </a>
    </div>
</div>
