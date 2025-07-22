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
        Schema::create('leases', function (Blueprint $table) {
           $table->id();
        
        // THESE TWO LINES ARE THE MOST IMPORTANT
        $table->foreignId('property_id')->constrained()->onDelete('cascade');
        $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
        
        // AND THESE ARE THE OTHER REQUIRED FIELDS
        $table->date('start_date');
        $table->date('end_date');
        $table->decimal('monthly_rent', 10, 2);
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leases');
    }
};
