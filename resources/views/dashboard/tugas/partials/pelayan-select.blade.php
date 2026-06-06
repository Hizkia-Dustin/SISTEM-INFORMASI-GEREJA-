@php
    $selectedValue = old($name, $selected ?? '');
    $selectOptions = collect($options ?? [])->filter()->unique()->values();
@endphp

<div>
    <label class="block mb-2 font-medium text-gray-700 text-sm">{{ $label }}</label>
    <div class="relative">
        <select name="{{ $name }}" class="w-full pr-10 px-4 py-3 rounded-xl border border-gray-200 bg-white outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-sm shadow-sm appearance-none cursor-pointer">
            <option value="">{{ $selectOptions->isEmpty() ? 'Belum ada pelayan aktif' : 'Pilih Nama Pelayan...' }}</option>
            @foreach($selectOptions as $option)
                <option value="{{ $option }}" @selected($selectedValue === $option)>{{ $option }}</option>
            @endforeach
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-400">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>
    </div>
</div>
