<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // This runs when you migrate
        Schema::table('properties', function (Blueprint $table) {
            // Add a boolean column named 'is_occupied'
            // We'll make it default to 'false' (0) for all existing properties.
           // AFTER (Change it to this)
        $table->boolean('is_occupied')->default(false)->after('address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // This runs if you ever need to rollback the migration
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('is_occupied'); // <-- ADD THIS LINE
        });
    }
};