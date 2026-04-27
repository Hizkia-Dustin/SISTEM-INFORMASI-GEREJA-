@props(['label', 'value', 'description' => null, 'icon' => null, 'trend' => null])

<div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden group hover:border-primary transition-all">
    <div class="flex items-start justify-between relative z-10">
        <div>
            <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1">{{ $label }}</p>
            <h3 class="text-3xl font-bold text-gray-800 tracking-tight">{{ $value }}</h3>
        </div>
        @if($icon)
        <div class="w-12 h-12 bg-blue-50 text-primary rounded-xl flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-all">
            {!! $icon !!}
        </div>
        @else
        <div class="w-12 h-12 bg-blue-50 text-primary rounded-xl flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
        </div>
        @endif
    </div>
    
    @if($trend || $description)
    <div class="mt-4 flex items-center gap-2 relative z-10">
        @if($trend)
        <span class="text-emerald-500 text-xs font-bold bg-emerald-50 px-2 py-0.5 rounded-lg">{{ $trend }}</span>
        @endif
        @if($description)
        <span class="text-gray-400 text-xs font-medium">{{ $description }}</span>
        @endif
    </div>
    @endif
</div>
