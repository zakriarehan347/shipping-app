<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row flex-wrap items-start sm:items-center justify-between gap-4">
            <div>
                <nav class="flex items-center gap-2 text-sm text-gray-500 mb-1" aria-label="{{ __('Breadcrumb') }}">
                    <a href="{{ route('dashboard') }}" class="hover:text-gray-700 transition">{{ __('Dashboard') }}</a>
                    <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <span class="text-gray-900 font-medium">{{ __('Shipments') }}</span>
                </nav>
                <h1 class="text-2xl font-bold tracking-tight text-gray-900">{{ __('Shipments') }}</h1>
                <p class="mt-1 text-sm text-gray-500">{{ __('All waybills — view and print') }}</p>
            </div>
            <a href="{{ route('shipments.create') }}" class="shrink-0 inline-flex items-center gap-2 px-6 py-4 text-base font-bold text-white rounded-lg transition shadow-lg" style="background:#1a1a1a;">
                <span style="font-size:1.25em;">+</span> {{ __('Add Shipment') }}
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow border border-gray-200 overflow-visible p-4">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

    @push('scripts')
        {{ $dataTable->scripts() }}
    @endpush
</x-app-layout>
