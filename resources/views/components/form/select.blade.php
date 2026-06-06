@props(['label', 'name'])

<div>
    <label class="block mb-2 font-medium text-gray-700 text-sm">{{ $label }}</label>
    <div class="relative">
        <select 
            name="{{ $name }}" 
            {{ $attributes->merge(['class' => 'w-full pr-10 px-4 py-3 rounded-xl border border-gray-200 bg-white outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-sm shadow-sm appearance-none cursor-pointer' . ($errors->has($name) ? ' border-red-500' : '')]) }}
        >
            {{ $slot }}
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-400">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
        </div>
    </div>
    @error($name)
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
