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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('category'); // Diesel, Cleaning Supplies, Maintenance, Other
            $table->decimal('amount', 10, 2); // Amount of the expense
            $table->text('description')->nullable(); // Optional description
            $table->unsignedBigInteger('created_by'); // User who created the expense
            $table->timestamps();

            // Foreign key relationship if you have a users table
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
