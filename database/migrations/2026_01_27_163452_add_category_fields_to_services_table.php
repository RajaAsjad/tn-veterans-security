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
            $table->string('category')->nullable()->after('is_active'); // e.g., 'security_training', 'nra', 'red_cross', 'handgun_carry', 'services'
            $table->string('subcategory')->nullable()->after('category'); // e.g., 'armed_security', 'asp', 'force_science', etc.
            $table->string('location')->nullable()->after('subcategory'); // e.g., 'Location A', 'Location B', or null for no specific location
            $table->boolean('requires_dallas_law')->default(false)->after('location');
            $table->boolean('requires_active_shooter')->default(false)->after('requires_dallas_law');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['category', 'subcategory', 'location', 'requires_dallas_law', 'requires_active_shooter']);
        });
    }
};
