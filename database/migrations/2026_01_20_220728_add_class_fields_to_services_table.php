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
        Schema::table('services', function (Blueprint $table) {
            // Pricing
            $table->decimal('price', 10, 2)->nullable()->after('description');
            $table->decimal('deposit_amount', 10, 2)->nullable()->after('price');
            
            // Class configuration
            $table->integer('duration_hours')->nullable()->after('deposit_amount'); // Class duration in hours
            $table->integer('max_students')->default(10)->after('duration_hours'); // Maximum students per class
            $table->integer('min_students')->default(2)->after('max_students'); // Minimum students (2 or 4)
            $table->enum('class_type', ['group', 'one-on-one'])->default('group')->after('min_students');
            $table->boolean('has_online_parts')->default(false)->after('class_type'); // Has online components
            $table->boolean('testing_in_person')->default(true)->after('has_online_parts'); // Testing is in-person
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'price',
                'deposit_amount',
                'duration_hours',
                'max_students',
                'min_students',
                'class_type',
                'has_online_parts',
                'testing_in_person',
            ]);
        });
    }
};
