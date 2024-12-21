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
            $table->decimal('card_payment', 10, 2)->nullable()->default(0)->after('payment_method');
            $table->decimal('cash_payment', 10, 2)->nullable()->default(0)->after('card_payment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('card_payment');
            $table->dropColumn('cash_payment');
        });
    }
};
