<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center no-print">
            <a href="{{ url()->previous() ?: route('shipments.index') }}" class="text-gray-600 hover:text-gray-900 text-sm">← {{ __('Back') }}</a>
            <button type="button" onclick="window.print();" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white text-sm font-semibold rounded-md hover:bg-gray-700">
                {{ __('Print Now') }}
            </button>
        </div>
    </x-slot>

    <p class="no-print text-sm text-gray-600 mb-4 text-center">Two copies per A4 page (landscape). Cut along the centre line to separate.</p>

    <div class="waybill-print-page bg-white text-black">
        <div class="waybill-copy">
            @include('shipments.partials.waybill-content', ['shipment' => $shipment])
        </div>
        <div class="waybill-copy waybill-copy-divider">
            @include('shipments.partials.waybill-content', ['shipment' => $shipment])
        </div>
    </div>

    <style>
    .waybill-print-page {
        display: flex;
        flex-direction: row;
        gap: 0;
        max-width: 297mm;
        margin: 0 auto;
        min-height: 180mm;
    }
    .waybill-copy {
        flex: 1 1 50%;
        width: 50%;
        box-sizing: border-box;
        padding: 6mm;
        border: 1px dashed #ccc;
    }
    .waybill-copy-divider { border-left: 2px dashed #999; }
    .waybill-copy-inner { height: 100%; }

    @media print {
        nav, body > div > header, .no-print { display: none !important; }
        body > div { background: #fff !important; }
        main { padding: 0 !important; }
        @page { size: A4 landscape; margin: 8mm; }
        .waybill-print-page {
            width: 100% !important;
            max-width: none !important;
            box-shadow: none !important;
            gap: 0 !important;
            page-break-after: avoid;
            page-break-inside: avoid;
        }
        .waybill-copy {
            border: none !important;
            padding: 6mm !important;
            break-inside: avoid;
            page-break-inside: avoid;
        }
        .waybill-copy-divider {
            border-left: 1px solid #333 !important;
        }
    }
    </style>
</x-app-layout>
