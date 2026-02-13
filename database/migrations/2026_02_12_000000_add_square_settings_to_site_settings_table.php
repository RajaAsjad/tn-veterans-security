<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('square_application_id')->nullable()->after('bank_sync_enabled');
            $table->string('square_access_token')->nullable()->after('square_application_id');
            $table->string('square_location_id')->nullable()->after('square_access_token');
            $table->string('square_environment')->nullable()->after('square_location_id')->default('sandbox');
            $table->boolean('square_enabled')->default(false)->after('square_environment');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'square_application_id',
                'square_access_token',
                'square_location_id',
                'square_environment',
                'square_enabled',
            ]);
        });
    }
};
