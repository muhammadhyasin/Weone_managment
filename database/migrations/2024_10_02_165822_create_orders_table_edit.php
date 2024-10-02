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
            $table->string('payment_method')->after('price')->nullable(); // Add payment_method column
            $table->string('payment_status')->after('payment_method')->nullable(); // Add payment_status column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('payment_method'); // Drop payment_method column
            $table->dropColumn('payment_status'); // Drop payment_status column
        });
    }
};
