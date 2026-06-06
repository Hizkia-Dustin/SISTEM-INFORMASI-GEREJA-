<x-layouts.main title="Tonton Video" :fullWidth="true">
    <div class="max-w-[1180px] mx-auto px-8 py-12 md:py-16">
        <div class="mb-8 flex items-center justify-between gap-4 flex-wrap">
            <a href="{{ route('video.index') }}" class="inline-flex items-center gap-2 font-label-md text-on-surface-variant hover:text-secondary transition-colors group">
                <span class="material-symbols-outlined text-[20px] group-hover:-translate-x-1 transition-transform">arrow_back</span>
                Kembali ke Galeri Video
            </a>

            <div class="flex items-center gap-2 text-sm text-on-surface-variant">
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Beranda</a>
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                <a href="{{ route('video.index') }}" class="hover:text-primary transition-colors">Video</a>
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                <span class="truncate max-w-[150px] text-primary font-medium">{{ $item->judul }}</span>
            </div>
        </div>

        @php
            $videoUrl = $item->gambar ? asset('storage/' . $item->gambar) : null;
            $videoExt = $videoUrl ? strtolower(pathinfo(parse_url($videoUrl, PHP_URL_PATH), PATHINFO_EXTENSION)) : null;
            $videoMime = $videoExt === 'mov' ? 'video/quicktime' : 'video/' . $videoExt;
        @endphp

        <article class="bg-white rounded-3xl overflow-hidden border border-outline-variant/30 shadow-sm">
            <div class="bg-slate-950">
                @if($videoUrl)
                    <video controls playsinline preload="metadata" class="w-full max-h-[680px] bg-black">
                        <source src="{{ $videoUrl }}" type="{{ $videoMime }}">
                        Browser tidak mendukung pemutar video.
                    </video>
                @else
                    <div class="h-[320px] flex items-center justify-center text-white/50">
                        <span class="material-symbols-outlined text-[72px]">videocam_off</span>
                    </div>
                @endif
            </div>

            <div class="p-8 md:p-12">
                <div class="mb-4 inline-block px-3 py-1 bg-secondary text-white rounded-md font-label-sm uppercase tracking-widest shadow-sm">
                    {{ $item->kategori ?? 'Video' }}
                </div>
                <h1 class="font-h1 text-3xl md:text-5xl font-bold leading-tight mb-4 text-primary-container">
                    {{ $item->judul }}
                </h1>
                <div class="flex flex-wrap items-center gap-4 font-caption md:text-base text-on-surface-variant mb-8">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">person</span>
                        <span>Admin GKI</span>
                    </div>
                    <span class="w-1.5 h-1.5 bg-outline-variant rounded-full"></span>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                        <span>{{ optional($item->created_at)->format('d M Y') }}</span>
                    </div>
                </div>

                <div class="prose prose-lg prose-slate max-w-none prose-p:font-body-lg prose-p:text-on-surface prose-p:leading-relaxed">
                    {!! $item->isi !!}
                </div>
            </div>
        </article>
    </div>
</x-layouts.main>
