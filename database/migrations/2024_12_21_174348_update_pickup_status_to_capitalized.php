<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Update all rows where pickup_status is 'pending' to 'Pending'
        DB::table('pickups')
            ->where('pickup_status', 'pending')
            ->update(['pickup_status' => 'Pending']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revert 'Pending' back to 'pending'
        DB::table('pickups')
            ->where('pickup_status', 'Pending')
            ->update(['pickup_status' => 'pending']);
    }
};
