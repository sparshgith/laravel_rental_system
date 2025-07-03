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
            $table->string('property_type'); // e.g., Apartment, House
            $table->string('main_image');     // Path to the uploaded image
            $table->string('location');       // e.g., Downtown
            $table->text('address');          // Full street address
            $table->integer('number_of_rooms');
            $table->string('furnish_status'); // e.g., Furnished, Unfurnished
            $table->decimal('monthly_rent', 10, 2);
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
