@props([
    'icon' => 'inbox',
    'title' => null,
    'description' => null,
    'actionLabel' => null,
    'actionUrl' => null,
    'clearFiltersUrl' => null,
])

@php
    $icons = [
        'inbox' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>',
    ];
    $path = $icons[$icon] ?? $icons['inbox'];
@endphp
<div class="px-6 py-16 text-center">
    <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-gray-100 text-gray-400 mb-4">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $path !!}</svg>
    </div>
    @if($title)
        <p class="text-gray-900 font-medium">{{ $title }}</p>
    @endif
    @if($description)
        <p class="text-gray-500 text-sm mt-1 max-w-sm mx-auto">{{ $description }}</p>
    @endif
    @if($clearFiltersUrl)
        <a href="{{ $clearFiltersUrl }}" class="mt-4 inline-block text-sm font-medium text-gray-600 hover:text-gray-900">
            {{ __('Clear filters') }}
        </a>
    @endif
    @if($actionLabel && $actionUrl)
        <a href="{{ $actionUrl }}" class="mt-5 inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-gray-900 rounded-lg hover:bg-gray-800 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            {{ $actionLabel }}
        </a>
    @endif
</div>
