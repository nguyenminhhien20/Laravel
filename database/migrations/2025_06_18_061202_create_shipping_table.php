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
        Schema::create('shipping', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('tracking_number')->nullable(); // mã vận đơn
            $table->string('carrier')->nullable(); // tên hãng vận chuyển (Giao hàng nhanh, Viettel Post,...)
            $table->string('status')->default('Chờ lấy hàng'); // Trạng thái vận chuyển
            $table->text('note')->nullable();
            $table->timestamp('shipped_at')->nullable(); // thời gian giao hàng
            $table->timestamp('delivered_at')->nullable(); // thời gian giao thành công
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('order')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping');
    }
};
