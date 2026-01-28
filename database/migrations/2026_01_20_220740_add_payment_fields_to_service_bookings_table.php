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
        Schema::table('service_bookings', function (Blueprint $table) {
            // Link to class schedule
            $table->foreignId('class_schedule_id')->nullable()->constrained('class_schedules')->onDelete('cascade')->after('service_id');
            
            // Payment fields
            $table->decimal('total_amount', 10, 2)->nullable()->after('class_schedule_id');
            $table->decimal('deposit_amount', 10, 2)->nullable()->after('total_amount');
            $table->decimal('remaining_amount', 10, 2)->nullable()->after('deposit_amount');
            $table->enum('payment_status', ['pending', 'deposit_paid', 'fully_paid', 'refunded'])->default('pending')->after('remaining_amount');
            
            // Booking type
            $table->enum('booking_type', ['group', 'one-on-one'])->default('group')->after('payment_status');
            
            // Additional fields
            $table->integer('number_of_students')->default(1)->after('booking_type'); // For group bookings
            $table->string('group_name')->nullable()->after('number_of_students'); // Group identifier if applicable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_bookings', function (Blueprint $table) {
            $table->dropForeign(['class_schedule_id']);
            $table->dropColumn([
                'class_schedule_id',
                'total_amount',
                'deposit_amount',
                'remaining_amount',
                'payment_status',
                'booking_type',
                'number_of_students',
                'group_name',
            ]);
        });
    }
};
