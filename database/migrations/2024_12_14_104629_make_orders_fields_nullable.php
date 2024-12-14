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
        Schema::table('orders', function (Blueprint $table) {
            $table->text('address')->nullable()->change();
            $table->string('phone_number')->nullable()->change();
            $table->string('postcode')->nullable()->change();
            $table->date('delivery_date')->nullable()->change();
            $table->time('delivery_start_time')->nullable()->change();
            $table->time('delivery_end_time')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->text('address')->nullable(false)->change();
            $table->string('phone_number')->nullable(false)->change();
            $table->string('postcode')->nullable(false)->change();
            $table->date('delivery_date')->nullable(false)->change();
            $table->time('delivery_start_time')->nullable(false)->change();
            $table->time('delivery_end_time')->nullable(false)->change();
        });
    }
};
