@props([
    'label',
    'value' => '-',
])

<div class="flex flex-col gap-1">
    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $label }}</span>
    <span class="text-sm font-bold text-gray-700 break-words">{{ $value ?: '-' }}</span>
</div>
