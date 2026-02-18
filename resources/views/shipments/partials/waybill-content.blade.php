@php
    $courierKey = $shipment->courier_service;
    $courierConfig = $courierKey ? (config("couriers.list.{$courierKey}") ?? null) : null;
    $courierName = $courierConfig['name'] ?? $courierKey ?? '—';
    $courierLogoFile = $courierConfig['logo'] ?? null;
    $courierLogoPath = $courierLogoFile ? "images/couriers/{$courierLogoFile}" : null;
    $hasCourierLogo = $courierLogoPath && file_exists(public_path($courierLogoPath));
@endphp
<div class="waybill-copy-inner text-sm leading-tight" style="font-family: system-ui, sans-serif;">
    <div class="flex justify-between items-start border-b border-black pb-2 mb-2">
        <div>
            <div class="flex items-center gap-2 mb-1">
                @if(file_exists(public_path('images/scs-logo.webp')) || file_exists(public_path('images/scs-logo.png')))
                    <picture>
                        @if(file_exists(public_path('images/scs-logo.webp')))
                            <source srcset="{{ asset('images/scs-logo.webp') }}" type="image/webp">
                        @endif
                        <img src="{{ asset(file_exists(public_path('images/scs-logo.png')) ? 'images/scs-logo.png' : 'images/scs-logo.webp') }}" alt="{{ config('app.name') }}" class="shrink-0 object-contain" style="width: 40px; height: 40px; max-width: 40px; max-height: 40px;" />
                    </picture>
                @else
                    <div class="w-10 h-10 shrink-0 rounded-full bg-amber-400 border-2 border-red-600 flex items-center justify-center text-red-600 font-bold text-xs">SCS</div>
                @endif
                <span class="font-bold text-sm uppercase tracking-tight">{{ config('app.name') }}</span>
                <p class="text-[10px]">Global Logistics & Shipping</p>
            </div>
            <p class="text-[10px]">Shop No#2, Basement 18 M-Block, Model Town Ext, Lahore</p>
        </div>
        <div class="text-right">
            @if($hasCourierLogo)
                <img src="{{ asset($courierLogoPath) }}" alt="{{ $courierName }}" class="ml-auto shrink-0 object-contain" style="width: 120px; height: 48px; max-width: 120px; max-height: 48px; object-fit: contain;" />
            @else
                <span class="font-bold text-sm">{{ $courierName }}</span>
            @endif
        </div>
    </div>

    <div class="border-b border-black py-0.5 mb-1">
        <p class="font-bold text-xs">WAYBILL -</p>
        <p class="text-[10px]">Not to be attached to package - Hand to Courier</p>
        <p class="text-[10px]">{{ $shipment->shipment_date->format('d M, Y') }} {{ $shipment->courier_service ? strtoupper(substr(str_replace(' ', '', $shipment->courier_service), 0, 6)) : '' }}</p>
    </div>

    <div class="flex justify-between border-b border-black py-1 mb-1">
        <div class="flex-1 min-w-0">
            <p class="font-bold text-xs mb-0.5">Shipper</p>
            <p class="break-words text-[10px]">{{ $shipment->shipper_name }}</p>
            <p class="break-words text-[10px]">{{ $shipment->shipper_address }}</p>
        </div>
        <div class="text-right text-[10px] ml-2">
            <p>Contact</p>
            <p>NTN# {{ $shipment->shipper_ntn ?? '—' }}</p>
            <p>CNIC# {{ $shipment->shipper_cnic ?? '—' }}</p>
            @if($shipment->shipper_phone)<p>{{ $shipment->shipper_phone }}</p>@endif
        </div>
    </div>

    <div class="flex justify-between border-b border-black py-1 mb-1">
        <div class="flex-1 min-w-0">
            <p class="font-bold text-xs mb-0.5">Receiver</p>
            <p class="break-words text-[10px]">{{ $shipment->receiver_name }}</p>
            <p class="break-words text-[10px]">{{ $shipment->receiver_address }}</p>
        </div>
        <div class="text-right text-[10px] ml-2">
            <p>Contact</p>
            <p>NTN# {{ $shipment->receiver_ntn ?? '—' }}</p>
            <p>{{ $shipment->receiver_phone ?? '—' }}</p>
        </div>
    </div>

    <div class="border-b border-black py-1 mb-1">
        <div class="grid grid-cols-[1fr_1fr_50px] gap-1 text-[10px] mb-0.5">
            <span class="font-bold">Product Details</span>
            <span class="font-bold">Features/Services</span>
            <span class="font-bold text-right">Value</span>
        </div>
        <div class="grid grid-cols-[1fr_1fr_50px] gap-1 text-[10px]">
            <span>{{ $shipment->quantity }} {{ $shipment->item_description }}</span>
            <span>—</span>
            <span class="text-right">{{ $shipment->value !== null && $shipment->value !== '' ? e($shipment->value) : '—' }}</span>
        </div>
    </div>

    <div class="border-b border-black py-0.5 mb-1">
        <p class="font-bold text-xs mb-0.5">Shipment Details</p>
        <p class="text-[10px]">Reference: {{ $shipment->shipper_name }} / {{ $shipment->waybill_number }}</p>
    </div>

    <div class="flex justify-between border-b border-black py-0.5 mb-1">
        <div>
            <p class="font-bold text-[10px] mb-0.5">Pices | Volume | Weight (UOM)</p>
            <p class="text-[10px]">{{ $shipment->quantity }} | {{ $shipment->volume !== null ? number_format($shipment->volume, 2) : '0.00' }} | {{ number_format($shipment->weight, 2) }}</p>
        </div>
        <div class="text-right">
            <p class="font-bold text-[10px] mb-0.5">Price</p>
            <p class="text-[10px]">{{ number_format($shipment->price, 2) }}</p>
        </div>
    </div>

    <div class="flex justify-between border-b border-black py-0.5 mb-1">
        <div class="grid grid-cols-3 gap-2 text-[10px] w-2/3">
            <span class="font-bold">Name(capital)</span>
            <span class="font-bold">Signature</span>
            <span class="font-bold">Date {{ now()->format('d M, Y') }}</span>
        </div>
        <div class="text-right text-[10px]">{{ $shipment->shipment_date->format('Y-m-d') }}</div>
    </div>

    <div class="flex justify-between items-end pt-1">
        <span class="font-bold text-xs">WAYBILL</span>
        <span class="text-lg font-bold tracking-wider">{{ $shipment->waybill_number }}</span>
    </div>
</div>
