@props(['routeName', 'active' => null, 'categories' => []])

@php
    $activeClass = 'px-5 py-2 rounded-full bg-secondary text-white font-label-md whitespace-nowrap shadow-sm';
    $inactiveClass = 'px-5 py-2 rounded-full bg-white border border-outline-variant text-on-surface-variant hover:border-secondary hover:text-secondary font-label-md whitespace-nowrap transition-colors shadow-sm';
@endphp

@if(!empty($categories))
<div class="flex flex-nowrap overflow-x-auto gap-3 mb-10 pb-2 no-scrollbar">
    <a href="{{ route($routeName) }}" class="{{ empty($active) ? $activeClass : $inactiveClass }}">Semua</a>
    @foreach($categories as $category)
        <a href="{{ route($routeName, ['kategori' => $category]) }}" class="{{ $active === $category ? $activeClass : $inactiveClass }}">
            {{ $category }}
        </a>
    @endforeach
</div>
@endif
