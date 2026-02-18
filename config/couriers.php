<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Courier Services
    |--------------------------------------------------------------------------
    |
    | Add courier services here. Use 'logo' => 'filename.png' when a logo
    | exists in public/images/couriers/. Omit or use null for name-only display.
    | To add a new logo: place the file in public/images/couriers/ and add
    | the filename here - no code changes needed.
    |
    */
    'list' => [
        'DHL'      => ['name' => 'DHL',      'logo' => 'dhl.png'],
        'Skynet'   => ['name' => 'Skynet',   'logo' => null],
        'FedEx'    => ['name' => 'FedEx',    'logo' => 'fedex.png'],
        'UPS'      => ['name' => 'UPS',      'logo' => 'ups.png'],
        'M&P'      => ['name' => 'M&P',      'logo' => null],
        'Leopards' => ['name' => 'Leopards', 'logo' => null],
        'TCS'      => ['name' => 'TCS',      'logo' => null],
    ],
];
