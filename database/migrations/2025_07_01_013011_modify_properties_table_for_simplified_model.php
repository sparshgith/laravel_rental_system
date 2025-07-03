<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * This method is executed when you run `php artisan migrate`.
     */
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            // Drop old columns if they exist
            if (Schema::hasColumn('properties', 'name')) {
                $table->dropColumn('name');
            }
            if (Schema::hasColumn('properties', 'address')) {
                $table->dropColumn('address');
            }
            if (Schema::hasColumn('properties', 'description')) {
                $table->dropColumn('description');
            }
            if (Schema::hasColumn('properties', 'price_per_month')) {
                $table->dropColumn('price_per_month');
            }
            if (Schema::hasColumn('properties', 'is_occupied')) {
                $table->dropColumn('is_occupied');
            }
            if (Schema::hasColumn('properties', 'brand_id')) {
                $table->dropForeign(['brand_id']);
                $table->dropColumn('brand_id');
            }
            if (Schema::hasColumn('properties', 'category_id')) {
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id');
            }

            // Ensure new columns exist (this prevents errors if you re-run migrations)
            if (!Schema::hasColumn('properties', 'model')) {
                $table->string('model');
            }
            if (!Schema::hasColumn('properties', 'image_url')) {
                $table->string('image_url');
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

    /**
     * Reverse the migrations.
     * This method is executed when you run `php artisan migrate:rollback`.
     */
    public function down(): void
    {
        // We can leave this empty for this case, or you could add
        // logic to re-create the old columns if you need to roll back.
    }
};
