@props(['label', 'name', 'type' => 'text', 'value' => '', 'placeholder' => ''])

<div>
    <label class="block mb-2 font-medium text-gray-700 text-sm">{{ $label }}</label>
    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        value="{{ $value }}" 
        placeholder="{{ $placeholder }}" 
        {{ $attributes->merge(['class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 bg-white outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-sm shadow-sm' . ($errors->has($name) ? ' border-red-500' : '')]) }}
    >
    @error($name)
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
