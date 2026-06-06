@props([
    'article',
    'backRoute',
    'backText' => 'Kembali',
    'breadcrumbParent' => 'Kumpulan Data',
])

<!-- Breadcrumb & Back Button -->
<div class="mb-8 flex items-center justify-between gap-4 flex-wrap">
    <a href="{{ $backRoute }}" class="inline-flex items-center gap-2 font-label-md text-on-surface-variant hover:text-secondary transition-colors group">
        <span class="material-symbols-outlined text-[20px] group-hover:-translate-x-1 transition-transform">arrow_back</span>
        {{ $backText }}
    </a>
    
    <div class="flex items-center gap-2 text-sm text-on-surface-variant">
        <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Beranda</a>
        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
        <a href="{{ $backRoute }}" class="hover:text-primary transition-colors">{{ $breadcrumbParent }}</a>
        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
        <span class="truncate max-w-[150px] text-primary font-medium">{{ $article->title }}</span>
    </div>
</div>

<!-- Article Container -->
<article class="max-w-4xl mx-auto bg-white rounded-3xl overflow-hidden border border-outline-variant/30 shadow-sm">
    @php
        $imageUrl = $article->image;
        $imagePath = parse_url($imageUrl, PHP_URL_PATH);
        $imageExt = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
        $isVideo = in_array($imageExt, ['mp4', 'webm', 'ogg']);
    @endphp
    <!-- Video Player -->
    <div class="w-full bg-black">
        @if($isVideo)
            <video controls preload="metadata" playsinline class="w-full h-auto max-h-[650px] bg-black">
                <source src="{{ $imageUrl }}" type="video/{{ $imageExt }}">
                Your browser does not support the video tag.
            </video>
        @else
            <img src="{{ $article->image }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
        @endif
    </div>

    <div class="p-8 md:p-12">
        <div class="mb-6 flex flex-col gap-4">
            <div class="inline-flex items-center gap-3 bg-secondary/10 text-secondary px-3 py-1 rounded-full text-sm font-semibold uppercase tracking-[0.2em]">
                {{ $article->category }}
            </div>
            <div>
                <h1 class="font-h1 text-3xl md:text-4xl font-bold text-primary-container leading-tight mb-3">
                    {{ $article->title }}
                </h1>
                <div class="flex flex-wrap items-center gap-6 text-sm text-on-surface-variant">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">person</span>
                        <span>{{ $article->author }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                        <span>{{ $article->date }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="prose prose-lg prose-slate max-w-none 
                    prose-headings:font-h2 prose-headings:text-primary-container
                    prose-p:font-body-lg prose-p:text-on-surface prose-p:leading-relaxed
                    prose-blockquote:border-l-4 prose-blockquote:border-secondary prose-blockquote:bg-surface-container prose-blockquote:p-6 prose-blockquote:rounded-r-xl prose-blockquote:font-serif prose-blockquote:text-primary prose-blockquote:italic
                    prose-ul:list-disc prose-ul:pl-6 prose-li:font-body-md prose-li:mb-2
                    prose-a:text-secondary hover:prose-a:text-primary transition-colors">
            @php
                $content = $article->content ?? '';
                $hasHtml = $content !== strip_tags($content);
            @endphp

            @if($hasHtml)
                {!! $content !!}
            @else
                {!! nl2br(e($content)) !!}
            @endif
        </div>
        
        <!-- Tags -->
        @if(!empty($article->tags))
            <div class="mt-12 pt-8 border-t border-outline-variant/30 flex items-center gap-3">
                <span class="font-label-md text-on-surface-variant">Tag:</span>
                <div class="flex flex-wrap gap-2">
                    @foreach($article->tags as $tag)
                        <a href="#" class="px-4 py-1.5 bg-surface-container hover:bg-secondary hover:text-white text-primary text-sm rounded-full transition-colors font-label-md">
                            #{{ $tag }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
    
</article>

<!-- Share & Action Floating -->
<div class="max-w-4xl mx-auto mt-8 flex flex-col sm:flex-row items-center justify-between gap-6">
    <div class="flex items-center gap-3">
        <span class="font-label-md text-on-surface-variant">Bagikan:</span>
        <button class="w-10 h-10 rounded-full bg-white border border-outline-variant text-primary-container hover:bg-[#25D366] hover:border-[#25D366] hover:text-white transition-all flex items-center justify-center shadow-sm" title="Share ke WhatsApp">
            <span class="material-symbols-outlined text-[20px]">chat</span>
        </button>
        <button class="w-10 h-10 rounded-full bg-white border border-outline-variant text-primary-container hover:bg-[#1877F2] hover:border-[#1877F2] hover:text-white transition-all flex items-center justify-center shadow-sm" title="Share ke Facebook">
            <span class="material-symbols-outlined text-[20px]">share</span>
        </button>
        <button class="w-10 h-10 rounded-full bg-white border border-outline-variant text-primary-container hover:bg-secondary hover:border-secondary hover:text-white transition-all flex items-center justify-center shadow-sm" title="Salin Tautan">
            <span class="material-symbols-outlined text-[20px]">link</span>
        </button>
    </div>
    
    <a href="{{ $backRoute }}" class="px-6 py-2.5 bg-primary-container text-white rounded-full font-label-md hover:bg-primary transition-colors shadow-sm text-center w-full sm:w-auto">
        Baca Konten Lainnya
    </a>
</div>
