<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->string('shipper_cnic')->nullable()->after('shipper_ntn');
            $table->string('receiver_ntn')->nullable()->after('receiver_phone');
        });
    }

    public function down(): void
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->dropColumn(['shipper_cnic', 'receiver_ntn']);
        });
    }
};
