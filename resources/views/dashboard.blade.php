<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row flex-wrap items-start sm:items-center justify-between gap-4">
            <div>
                <nav class="flex items-center gap-2 text-sm text-gray-500 mb-1" aria-label="{{ __('Breadcrumb') }}">
                    <span class="text-gray-900 font-medium">{{ __('Dashboard') }}</span>
                </nav>
                <h1 class="text-2xl font-bold tracking-tight text-gray-900">{{ __('Dashboard') }}</h1>
                <p class="mt-1 text-sm text-gray-500">{{ __('Overview of your waybills and shipping activity') }}</p>
            </div>
            <a href="{{ route('shipments.create') }}" class="shrink-0 inline-flex items-center gap-2 px-6 py-4 text-base font-bold text-white rounded-lg transition shadow-lg" style="background:#1a1a1a;">
                <span style="font-size:1.25em;">+</span> {{ __('Add Shipment') }}
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Latest 10 shipments (same list view as shipments page) --}}
            <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
                <div class="px-4 sm:px-6 py-4 border-b border-gray-200 flex flex-wrap items-center justify-between gap-3">
                    <h2 class="text-lg font-semibold text-gray-900">{{ __('Latest 10 shipments') }}</h2>
                    <a href="{{ route('shipments.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700 inline-flex items-center gap-1.5 transition">
                        {{ __('View all shipments') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
                <div class="p-4">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        {{ $dataTable->scripts() }}
    @endpush
</x-app-layout>
