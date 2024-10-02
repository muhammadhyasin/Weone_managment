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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); 
            $table->string('product_item_no'); 
            $table->string('product_name');
            $table->string('customer_name');
            $table->text('address'); 
            $table->string('phone_number'); 
            $table->string('postcode'); 
            $table->date('delivery_date');
            $table->timestamp('delivery_start_time');
            $table->timestamp('delivery_end_time');
            $table->decimal('price', 10, 2); 
            $table->string('created_by'); 
            $table->string('updated_by')->nullable(); 
            $table->timestamps(); 
            $table->string('status'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
