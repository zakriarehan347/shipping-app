<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Shipment') }}
            </h2>
            <a href="{{ route('shipments.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                {{ __('← Back to Shipments') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('shipments.update', $shipment) }}" method="POST" class="p-6 space-y-8">
                    @csrf
                    @method('PUT')

                    {{-- Waybill, Courier, Date --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <div>
                            <x-input-label for="waybill_number" :value="__('Waybill Number')" />
                            <x-text-input id="waybill_number" name="waybill_number" type="text" class="mt-1 block w-full"
                                :value="old('waybill_number', $shipment->waybill_number)" required autofocus />
                            <x-input-error :messages="$errors->get('waybill_number')" class="mt-1" />
                        </div>
                        <div>
                            <x-input-label for="courier_service" :value="__('Courier Service')" />
                            <select id="courier_service" name="courier_service" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">{{ __('Select courier') }}</option>
                                @foreach($couriers as $key => $courier)
                                    <option value="{{ $key }}" @selected(old('courier_service', $shipment->courier_service) === (string)$key)>{{ is_array($courier) ? $courier['name'] : $courier }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('courier_service')" class="mt-1" />
                        </div>
                        <div>
                            <x-input-label for="shipment_date" :value="__('Date')" />
                            <x-text-input id="shipment_date" name="shipment_date" type="date" class="mt-1 block w-full"
                                :value="old('shipment_date', $shipment->shipment_date?->format('Y-m-d'))" required />
                            <x-input-error :messages="$errors->get('shipment_date')" class="mt-1" />
                        </div>
                    </div>

                    {{-- Shipper --}}
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Shipper') }}</h3>
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <x-input-label for="shipper_name" :value="__('Name')" />
                                <x-text-input id="shipper_name" name="shipper_name" type="text" class="mt-1 block w-full"
                                    :value="old('shipper_name', $shipment->shipper_name)" required />
                                <x-input-error :messages="$errors->get('shipper_name')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="shipper_address" :value="__('Address')" />
                                <textarea id="shipper_address" name="shipper_address" rows="2" required
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('shipper_address', $shipment->shipper_address) }}</textarea>
                                <x-input-error :messages="$errors->get('shipper_address')" class="mt-1" />
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="shipper_phone" :value="__('Phone')" />
                                    <x-text-input id="shipper_phone" name="shipper_phone" type="text" class="mt-1 block w-full"
                                        :value="old('shipper_phone', $shipment->shipper_phone)" />
                                    <x-input-error :messages="$errors->get('shipper_phone')" class="mt-1" />
                                </div>
                                <div>
                                    <x-input-label for="shipper_ntn" :value="__('NTN#')" />
                                    <x-text-input id="shipper_ntn" name="shipper_ntn" type="text" class="mt-1 block w-full"
                                        :value="old('shipper_ntn', $shipment->shipper_ntn)" />
                                    <x-input-error :messages="$errors->get('shipper_ntn')" class="mt-1" />
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Receiver --}}
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Receiver') }}</h3>
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <x-input-label for="receiver_name" :value="__('Name')" />
                                <x-text-input id="receiver_name" name="receiver_name" type="text" class="mt-1 block w-full"
                                    :value="old('receiver_name', $shipment->receiver_name)" required />
                                <x-input-error :messages="$errors->get('receiver_name')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="receiver_address" :value="__('Address')" />
                                <textarea id="receiver_address" name="receiver_address" rows="2" required
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('receiver_address', $shipment->receiver_address) }}</textarea>
                                <x-input-error :messages="$errors->get('receiver_address')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="receiver_phone" :value="__('Phone')" />
                                <x-text-input id="receiver_phone" name="receiver_phone" type="text" class="mt-1 block w-full"
                                    :value="old('receiver_phone', $shipment->receiver_phone)" />
                                <x-input-error :messages="$errors->get('receiver_phone')" class="mt-1" />
                            </div>
                        </div>
                    </div>

                    {{-- Product / Shipment details --}}
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Product & Shipment Details') }}</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div class="sm:col-span-2">
                                <x-input-label for="item_description" :value="__('Item Description')" />
                                <x-text-input id="item_description" name="item_description" type="text" class="mt-1 block w-full"
                                    :value="old('item_description', $shipment->item_description)" required />
                                <x-input-error :messages="$errors->get('item_description')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="quantity" :value="__('Quantity')" />
                                <x-text-input id="quantity" name="quantity" type="number" min="1" class="mt-1 block w-full"
                                    :value="old('quantity', $shipment->quantity)" required />
                                <x-input-error :messages="$errors->get('quantity')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="weight" :value="__('Weight')" />
                                <x-text-input id="weight" name="weight" type="number" step="0.01" min="0" class="mt-1 block w-full"
                                    :value="old('weight', $shipment->weight)" required />
                                <x-input-error :messages="$errors->get('weight')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="price" :value="__('Price')" />
                                <x-text-input id="price" name="price" type="number" step="0.01" min="0" class="mt-1 block w-full"
                                    :value="old('price', $shipment->price)" required />
                                <x-input-error :messages="$errors->get('price')" class="mt-1" />
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                        <a href="{{ route('shipments.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            {{ __('Cancel') }}
                        </a>
                        <x-primary-button>{{ __('Update Shipment') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
