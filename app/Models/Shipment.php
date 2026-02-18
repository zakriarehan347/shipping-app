<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'waybill_number',
        'courier_service',
        'shipper_name',
        'shipper_address',
        'shipper_phone',
        'shipper_ntn',
        'shipper_cnic',
        'receiver_name',
        'receiver_address',
        'receiver_phone',
        'receiver_ntn',
        'item_description',
        'quantity',
        'weight',
        'price',
        'value',
        'volume',
        'shipment_date',
    ];

    protected function casts(): array
    {
        return [
            'shipment_date' => 'date',
            'quantity' => 'integer',
            'weight' => 'decimal:2',
            'price' => 'decimal:2',
            'volume' => 'decimal:2',
        ];
    }
}
