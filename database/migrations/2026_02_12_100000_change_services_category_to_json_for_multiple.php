<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->json('categories')->nullable()->after('order');
        });

        // Migrate existing single category to JSON array
        $services = DB::table('services')->get();
        foreach ($services as $service) {
            $oldCategory = $service->category ?? null;
            $categories = $oldCategory ? json_encode([$oldCategory]) : null;
            DB::table('services')->where('id', $service->id)->update(['categories' => $categories]);
        }

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('category')->nullable()->after('order');
        });

        $services = DB::table('services')->get();
        foreach ($services as $service) {
            $cats = $service->categories ? json_decode($service->categories, true) : null;
            $first = is_array($cats) && count($cats) > 0 ? $cats[0] : null;
            DB::table('services')->where('id', $service->id)->update(['category' => $first]);
        }

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('categories');
        });
    }
};
