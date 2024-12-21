<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('revenues', function (Blueprint $table) {
            $table->unsignedBigInteger('pickup_id')->nullable()->after('id');
            $table->foreign('pickup_id')->references('id')->on('pickups')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('revenues', function (Blueprint $table) {
            $table->dropForeign(['pickup_id']);
            $table->dropColumn('pickup_id');
        });
    }
};
