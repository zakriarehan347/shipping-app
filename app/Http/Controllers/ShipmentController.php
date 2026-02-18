<?php

namespace App\Http\Controllers;

use App\DataTables\ShipmentsDataTable;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ShipmentController extends Controller
{
    public function index(ShipmentsDataTable $dataTable)
    {
        return $dataTable->render('shipments.index');
    }

    public function create()
    {
        $couriers = config('couriers.list', []);
        return view('shipments.create', compact('couriers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'waybill_number' => ['required', 'string', 'max:255', Rule::unique('shipments', 'waybill_number')],
            'courier_service' => ['nullable', 'string', 'max:100'],
            'shipper_name' => ['required', 'string', 'max:255'],
            'shipper_address' => ['required', 'string'],
            'shipper_phone' => ['nullable', 'string', 'max:50'],
            'shipper_ntn' => ['nullable', 'string', 'max:50'],
            'receiver_name' => ['required', 'string', 'max:255'],
            'receiver_address' => ['required', 'string'],
            'receiver_phone' => ['nullable', 'string', 'max:50'],
            'item_description' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'integer', 'min:1'],
            'weight' => ['required', 'numeric', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'],
            'shipment_date' => ['required', 'date'],
        ]);

        $shipment = Shipment::create($validated);

        return redirect()->route('shipments.show', $shipment)
            ->with('status', __('Shipment created successfully.'));
    }

    public function show(Shipment $shipment)
    {
        return view('shipments.show', compact('shipment'));
    }

    public function edit(Shipment $shipment)
    {
        $couriers = config('couriers.list', []);
        return view('shipments.edit', compact('shipment', 'couriers'));
    }

    public function update(Request $request, Shipment $shipment)
    {
        $validated = $request->validate([
            'waybill_number' => ['required', 'string', 'max:255', Rule::unique('shipments', 'waybill_number')->ignore($shipment->id)],
            'courier_service' => ['nullable', 'string', 'max:100'],
            'shipper_name' => ['required', 'string', 'max:255'],
            'shipper_address' => ['required', 'string'],
            'shipper_phone' => ['nullable', 'string', 'max:50'],
            'shipper_ntn' => ['nullable', 'string', 'max:50'],
            'receiver_name' => ['required', 'string', 'max:255'],
            'receiver_address' => ['required', 'string'],
            'receiver_phone' => ['nullable', 'string', 'max:50'],
            'item_description' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'integer', 'min:1'],
            'weight' => ['required', 'numeric', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'],
            'shipment_date' => ['required', 'date'],
        ]);

        $shipment->update($validated);

        return redirect()->route('shipments.index')
            ->with('status', __('Shipment updated successfully.'));
    }

    public function destroy(Shipment $shipment)
    {
        $shipment->delete();
        return redirect()->route('shipments.index')
            ->with('status', __('Shipment deleted successfully.'));
    }
}
