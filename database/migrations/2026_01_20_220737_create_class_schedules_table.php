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
        Schema::create('class_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            
            // Schedule details
            $table->date('class_date');
            $table->time('start_time');
            $table->time('end_time')->nullable(); // Calculated from start_time + duration
            $table->integer('duration_hours'); // Override service duration if needed
            
            // Capacity management
            $table->integer('max_students')->default(10); // Override service max if needed
            $table->integer('min_students')->default(2); // Override service min if needed
            $table->integer('current_students')->default(0); // Track enrolled students
            
            // Location and instructor
            $table->string('room')->nullable(); // Room name/number
            $table->string('instructor')->nullable(); // Instructor name
            $table->boolean('can_overlap')->default(true); // Can overlap with other classes
            
            // Status
            $table->enum('status', ['scheduled', 'full', 'cancelled', 'completed'])->default('scheduled');
            $table->text('notes')->nullable();
            
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['class_date', 'start_time']);
            $table->index(['service_id', 'class_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_schedules');
    }
};
