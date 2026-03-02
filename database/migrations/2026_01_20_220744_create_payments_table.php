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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('service_bookings')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            
            // Payment details
            $table->decimal('amount', 10, 2);
            $table->enum('payment_type', ['deposit', 'full_payment', 'remaining_balance', 'refund'])->default('deposit');
            $table->enum('payment_method', ['credit_card', 'debit_card', 'bank_transfer', 'cash', 'check', 'other'])->default('credit_card');
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            
            // Transaction details
            $table->string('transaction_id')->nullable()->unique();
            $table->string('payment_gateway')->nullable(); // Stripe, PayPal, etc.
            $table->text('gateway_response')->nullable(); // JSON response from payment gateway
            
            // QuickBooks integration
            $table->boolean('synced_to_quickbooks')->default(false);
            $table->string('quickbooks_invoice_id')->nullable();
            $table->string('quickbooks_payment_id')->nullable();
            $table->timestamp('quickbooks_synced_at')->nullable();
            
            // Bank account sync
            $table->boolean('synced_to_bank')->default(false);
            $table->timestamp('bank_synced_at')->nullable();
            
            // Additional info
            $table->text('notes')->nullable();
            $table->date('payment_date');
            
            $table->timestamps();
            
            // Indexes
            $table->index(['booking_id', 'status']);
            $table->index(['customer_id', 'payment_date']);
            $table->index('transaction_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
