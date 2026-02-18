@php
    $date = $shipment->shipment_date;
    $today = \Carbon\Carbon::today();
    if ($date->isFuture()) {
        $status = 'pending';
        $label = __('Pending');
        $class = 'bg-amber-100 text-amber-700';
    } elseif ($date->diffInDays($today) > 30) {
        $status = 'inactive';
        $label = __('Inactive');
        $class = 'bg-red-100 text-red-700';
    } else {
        $status = 'active';
        $label = $date->isToday() ? __('Active') : __('Delivered');
        $class = 'bg-green-100 text-green-700';
    }
@endphp
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $class }}">{{ $label }}</span>
