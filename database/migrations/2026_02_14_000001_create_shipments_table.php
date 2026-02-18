<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('waybill_number')->unique();
            $table->string('shipper_name');
            $table->text('shipper_address');
            $table->string('shipper_phone')->nullable();
            $table->string('shipper_ntn')->nullable();
            $table->string('receiver_name');
            $table->text('receiver_address');
            $table->string('receiver_phone')->nullable();
            $table->string('item_description');
            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('weight', 10, 2)->default(0);
            $table->decimal('price', 12, 2)->default(0);
            $table->date('shipment_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
