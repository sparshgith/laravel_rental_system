<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            // Safely drop old car-related columns
            if (Schema::hasColumn('properties', 'model')) {
                $table->dropColumn(['model', 'color', 'mileage', 'efficiency', 'price', 'stock']);
            }
        });

        Schema::table('properties', function (Blueprint $table) {
            // Safely add new real-estate columns
            if (!Schema::hasColumn('properties', 'property_type')) {
                $table->string('property_type');
            }
            if (!Schema::hasColumn('properties', 'location')) {
                $table->string('location');
            }
            if (!Schema::hasColumn('properties', 'address')) {
                $table->text('address');
            }
            if (!Schema::hasColumn('properties', 'number_of_rooms')) {
                $table->integer('number_of_rooms');
            }
            if (!Schema::hasColumn('properties', 'furnish_status')) {
                $table->string('furnish_status');
            }
            if (!Schema::hasColumn('properties', 'monthly_rent')) {
                $table->decimal('monthly_rent', 10, 2);
            }
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            // Drop new columns (check if they exist first)
            if (Schema::hasColumn('properties', 'property_type')) {
                $table->dropColumn('property_type');
            }
            if (Schema::hasColumn('properties', 'location')) {
                $table->dropColumn('location');
            }
            if (Schema::hasColumn('properties', 'address')) {
                $table->dropColumn('address');
            }
            if (Schema::hasColumn('properties', 'number_of_rooms')) {
                $table->dropColumn('number_of_rooms');
            }
            if (Schema::hasColumn('properties', 'furnish_status')) {
                $table->dropColumn('furnish_status');
            }
            if (Schema::hasColumn('properties', 'monthly_rent')) {
                $table->dropColumn('monthly_rent');
            }

            // Restore old car-related columns
            if (!Schema::hasColumn('properties', 'model')) {
                $table->string('model');
            }
            if (!Schema::hasColumn('properties', 'color')) {
                $table->string('color')->nullable();
            }
            if (!Schema::hasColumn('properties', 'mileage')) {
                $table->integer('mileage')->nullable();
            }
            if (!Schema::hasColumn('properties', 'efficiency')) {
                $table->string('efficiency')->nullable();
            }
            if (!Schema::hasColumn('properties', 'price')) {
                $table->decimal('price', 10, 2);
            }
            if (!Schema::hasColumn('properties', 'stock')) {
                $table->integer('stock')->default(0);
            }
        });
    }
};
