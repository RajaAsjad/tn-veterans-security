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
        Schema::table('site_settings', function (Blueprint $table) {
            // QuickBooks API Configuration
            $table->string('quickbooks_client_id')->nullable()->after('youtube_url');
            $table->string('quickbooks_client_secret')->nullable()->after('quickbooks_client_id');
            $table->string('quickbooks_company_id')->nullable()->after('quickbooks_client_secret');
            $table->string('quickbooks_environment')->nullable()->after('quickbooks_company_id')->default('sandbox'); // sandbox or production
            $table->text('quickbooks_access_token')->nullable()->after('quickbooks_environment');
            $table->text('quickbooks_refresh_token')->nullable()->after('quickbooks_access_token');
            $table->boolean('quickbooks_enabled')->default(false)->after('quickbooks_refresh_token');
            
            // Bank API Configuration
            $table->string('bank_api_provider')->nullable()->after('quickbooks_enabled'); // plaid, yodlee, etc.
            $table->string('bank_api_key')->nullable()->after('bank_api_provider');
            $table->string('bank_api_secret')->nullable()->after('bank_api_key');
            $table->string('bank_account_id')->nullable()->after('bank_api_secret');
            $table->boolean('bank_sync_enabled')->default(false)->after('bank_account_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'quickbooks_client_id',
                'quickbooks_client_secret',
                'quickbooks_company_id',
                'quickbooks_environment',
                'quickbooks_access_token',
                'quickbooks_refresh_token',
                'quickbooks_enabled',
                'bank_api_provider',
                'bank_api_key',
                'bank_api_secret',
                'bank_account_id',
                'bank_sync_enabled',
            ]);
        });
    }
};
