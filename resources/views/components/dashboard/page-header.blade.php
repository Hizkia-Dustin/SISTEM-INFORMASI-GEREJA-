@props(['title', 'subtitle' => null, 'backUrl' => null, 'backLabel' => 'Kembali'])

<div class="flex items-center justify-between mb-10">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-800 tracking-tight">{{ $title }}</h1>
        @if($subtitle)
            <p class="text-gray-400 text-sm font-medium mt-1">{{ $subtitle }}</p>
        @endif
    </div>
    
    <div class="flex items-center gap-4">
        {{ $slot }}
        
        @if($backUrl)
            <a href="{{ $backUrl }}" class="flex items-center gap-2 px-4 py-2 text-gray-400 font-bold text-xs uppercase tracking-widest hover:text-primary transition-all border border-transparent hover:border-gray-100 rounded-xl">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M15 19l-7-7 7-7"/></svg>
                {{ $backLabel }}
            </a>
        @endif
    </div>
</div>
