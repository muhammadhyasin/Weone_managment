<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddCompletedPickupsToExpensesAndRevenues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Fetch completed pickups
        $completedPickups = DB::table('pickups')
            ->where('pickup_status', 'Completed')
            ->get();

        foreach ($completedPickups as $pickup) {
            // Insert into the expenses table
            DB::table('expenses')->insert([
                'amount' => $pickup->price,
                'category' => 'pickup',
                'description' => 'Pickup for product item no ' . $pickup->product_item_no,
                'created_by' => $pickup->updated_by,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Insert into the revenues table
            DB::table('revenues')->insert([
                'amount' => -$pickup->price,
                'source' => 'pickup',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Delete records inserted in the expenses table
        DB::table('expenses')->where('category', 'pickup')->delete();

        // Delete records inserted in the revenues table
        DB::table('revenues')->where('source', 'pickup')->delete();
    }
}
