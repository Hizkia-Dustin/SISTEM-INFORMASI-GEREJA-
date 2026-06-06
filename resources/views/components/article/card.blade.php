@props(['article', 'url', 'buttonText' => 'Baca Artikel'])

<article class="relative bg-white rounded-2xl overflow-hidden border border-outline-variant/50 shadow-sm hover:shadow-lg transition-all duration-300 group flex flex-col h-full hover:-translate-y-1">
    <!-- Thumbnail -->
    @php
        $imageUrl = $article->image;
        $imagePath = parse_url($imageUrl, PHP_URL_PATH);
        $imageExt = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
        $isVideo = in_array($imageExt, ['mp4', 'webm', 'ogg', 'mov']);
        $videoMime = $imageExt === 'mov' ? 'video/quicktime' : 'video/' . $imageExt;
    @endphp
    <div class="aspect-[16/10] overflow-hidden relative">
        @if($isVideo)
            <video muted loop playsinline preload="metadata" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                <source src="{{ $imageUrl }}" type="{{ $videoMime }}">
                Your browser does not support the video tag.
            </video>
        @else
            <img src="{{ $imageUrl }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
        @endif
        <!-- Kategori Badge -->
        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-md px-3 py-1 rounded-md">
            <span class="font-label-sm text-secondary uppercase tracking-wider">{{ $article->category ?? 'Umum' }}</span>
        </div>
    </div>
    
    <!-- Konten -->
    <div class="p-6 flex flex-col flex-grow">
        <!-- Meta Data -->
        <div class="flex items-center gap-3 font-caption text-on-surface-variant mb-4">
            <div class="flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                <span>{{ $article->date }}</span>
            </div>
            <span class="w-1 h-1 bg-outline-variant rounded-full"></span>
            <div class="flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">person</span>
                <span class="truncate max-w-[120px]">{{ $article->author ?? 'Admin' }}</span>
            </div>
        </div>

        @if(!empty($article->verse))
            <div class="mb-4">
                <span class="inline-flex items-center rounded-full bg-[#e5eeff] px-3 py-1 text-xs font-semibold tracking-wide text-[#0b3f91]">
                    {{ $article->verse }}
                </span>
            </div>
        @endif
        
        <!-- Judul -->
        <h2 class="font-h3 text-h3 text-primary-container mb-3 group-hover:text-secondary transition-colors line-clamp-2">
            <a href="{{ $url }}" class="focus:outline-none">
                <span class="absolute inset-0" aria-hidden="true"></span>
                {{ $article->title }}
            </a>
        </h2>
        
        <!-- Ringkasan -->
        <p class="font-body-md text-on-surface-variant leading-relaxed mb-6 line-clamp-3 flex-grow">
            {{ $article->excerpt }}
        </p>
        
        <!-- Tombol Aksi -->
        <div class="mt-auto flex items-center font-label-md text-secondary uppercase tracking-widest group-hover:text-primary-container transition-colors">
            <span>{{ $buttonText }}</span>
            <span class="material-symbols-outlined ml-1 group-hover:translate-x-2 transition-transform duration-300">arrow_forward</span>
        </div>
    </div>
</article>
