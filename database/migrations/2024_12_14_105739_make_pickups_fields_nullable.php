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
        Schema::table('pickups', function (Blueprint $table) {
            $table->text('pickup_address')->nullable()->change();
            $table->string('phone_number')->nullable()->change();
            $table->string('postcode')->nullable()->change();
            $table->date('pickup_date')->nullable()->change();
            $table->time('pickup_start_time')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pickups', function (Blueprint $table) {
            $table->text('pickup_address')->nullable(false)->change();
            $table->string('phone_number')->nullable(false)->change();
            $table->string('postcode')->nullable(false)->change();
            $table->date('pickup_date')->nullable(false)->change();
            $table->time('pickup')->nullable(false)->change();
        });
    }
};
