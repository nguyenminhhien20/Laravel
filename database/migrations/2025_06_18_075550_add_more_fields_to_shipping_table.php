<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('shipping', function (Blueprint $table) {
            $table->string('shipping_partner')->nullable()->after('order_id');
            $table->timestamp('estimated_delivery_date')->nullable()->after('status');
            $table->string('shipping_address')->nullable()->after('estimated_delivery_date');
        });
    }

    public function down(): void
    {
        Schema::table('shipping', function (Blueprint $table) {
            $table->dropColumn(['shipping_partner', 'estimated_delivery_date', 'shipping_address']);
        });
    }
};
