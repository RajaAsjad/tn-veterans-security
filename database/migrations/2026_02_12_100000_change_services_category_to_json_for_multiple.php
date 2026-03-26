<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('services')) {
            return;
        }

        if (!Schema::hasColumn('services', 'categories')) {
            Schema::table('services', function (Blueprint $table) {
                $table->json('categories')->nullable()->after('order');
            });
        }

        // Migrate existing single category to JSON array when old column exists.
        if (Schema::hasColumn('services', 'category') && Schema::hasColumn('services', 'categories')) {
            $services = DB::table('services')->select('id', 'category')->get();
            foreach ($services as $service) {
                $oldCategory = $service->category ?? null;
                $categories = $oldCategory ? json_encode([$oldCategory]) : null;
                DB::table('services')->where('id', $service->id)->update(['categories' => $categories]);
            }
        }

        if (Schema::hasColumn('services', 'category')) {
            Schema::table('services', function (Blueprint $table) {
                $table->dropColumn('category');
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('services')) {
            return;
        }

        if (!Schema::hasColumn('services', 'category')) {
            Schema::table('services', function (Blueprint $table) {
                $table->string('category')->nullable()->after('order');
            });
        }

        if (Schema::hasColumn('services', 'categories') && Schema::hasColumn('services', 'category')) {
            $services = DB::table('services')->select('id', 'categories')->get();
            foreach ($services as $service) {
                $cats = $service->categories ? json_decode($service->categories, true) : null;
                $first = is_array($cats) && count($cats) > 0 ? $cats[0] : null;
                DB::table('services')->where('id', $service->id)->update(['category' => $first]);
            }
        }

        if (Schema::hasColumn('services', 'categories')) {
            Schema::table('services', function (Blueprint $table) {
                $table->dropColumn('categories');
            });
        }
    }
};
