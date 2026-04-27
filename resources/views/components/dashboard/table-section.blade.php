@props(['title', 'actionText' => null, 'actionUrl' => null])

<div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-white/50 backdrop-blur-sm">
        <h2 class="text-lg font-semibold text-gray-800">{{ $title }}</h2>
        @if($actionText && $actionUrl)
            <a href="{{ $actionUrl }}" class="text-sm font-medium text-primary hover:text-blue-800 transition-colors">{{ $actionText }}</a>
        @endif
    </div>
    <div class="w-full overflow-x-auto">
        <table class="w-full border-collapse">
            {{ $slot }}
        </table>
    </div>
</div>
