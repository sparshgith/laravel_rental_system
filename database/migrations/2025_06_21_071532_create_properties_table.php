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
        Schema::create('properties', function (Blueprint $table) {
             $table->id();
        $table->string('name')->nullable(); // Make it nullable as we auto-generate it
        $table->text('address');
        $table->text('description')->nullable();
        
        // Your new fields
        $table->string('property_type'); // This must not be nullable
        $table->string('location');
        $table->integer('number_of_rooms');
        $table->string('furnish_status');
        $table->string('main_image')->nullable();
        $table->decimal('monthly_rent', 10, 2); // Corrected name and increased size
        
        $table->boolean('is_occupied')->default(false);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
