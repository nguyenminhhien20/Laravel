<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalAmountToOrderTable extends Migration
{
    public function up()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->decimal('total_amount', 15, 2)->default(0)->after('user_id');
            // decimal(15,2) là kiểu số có 15 chữ số, 2 chữ số thập phân
        });
    }

    public function down()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->dropColumn('total_amount');
        });
    }
}
