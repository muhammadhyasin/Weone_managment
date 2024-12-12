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
        Schema::table('logs', function (Blueprint $table) {
            // Make order_id nullable
            $table->foreignId('order_id')->nullable()->change();

            // Add pickup_id column
            $table->foreignId('pickup_id')->nullable()->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('logs', function (Blueprint $table) {
            // Remove pickup_id column
            $table->dropForeign(['pickup_id']);
            $table->dropColumn('pickup_id');

            // Revert order_id to non-nullable
            $table->foreignId('order_id')->nullable(false)->change();
        });
    }
};
