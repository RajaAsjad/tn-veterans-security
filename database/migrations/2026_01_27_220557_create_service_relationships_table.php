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
        Schema::create('service_relationships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_service_id')->constrained('services')->onDelete('cascade');
            $table->foreignId('linked_service_id')->constrained('services')->onDelete('cascade');
            $table->integer('order')->default(0);
            $table->timestamps();
            
            // Prevent duplicate relationships
            $table->unique(['parent_service_id', 'linked_service_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_relationships');
    }
};
