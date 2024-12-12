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
        Schema::create('pickups', function (Blueprint $table) {
            $table->id();
            $table->string('product_item_no');
            $table->string('product_name');
            $table->string('customer_name');
            $table->text('pickup_address');
            $table->string('phone_number');
            $table->string('postcode');
            $table->date('pickup_date');
            $table->time('pickup_start_time');
            $table->decimal('price', 10, 2);
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->string('pickup_status');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pickups');
    }
};
