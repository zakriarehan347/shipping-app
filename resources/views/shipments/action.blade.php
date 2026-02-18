<div class="flex justify-center overflow-visible">
    <x-dropdown align="right" width="48" contentClasses="py-1" :fixed="true">
        <x-slot name="trigger">
            <button type="button" class="p-1.5 rounded text-gray-400 hover:text-gray-600 hover:bg-gray-100">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg>
            </button>
        </x-slot>
        <x-slot name="content">
            <a href="{{ route('shipments.edit', $model) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ __('Edit') }}</a>
        </x-slot>
    </x-dropdown>
</div>
