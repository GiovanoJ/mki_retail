<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->json('categories')->nullable()->after('category');
        });

        DB::table('products')->get()->each(function ($product) {
            if ($product->category) {
                DB::table('products')
                    ->where('id', $product->id)
                    ->update([
                        'categories' => json_encode([strtolower(str_replace(' ', '_', $product->category))]),
                    ]);
            }
        });

        // 3. Hapus kolom lama
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('category');
        });

        // 4. Rename kolom baru
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('categories', 'category');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->json('categories')->nullable()->after('category');
        });

        DB::table('products')->get()->each(function ($product) {
            $cats = json_decode($product->category, true);
            $first = is_array($cats) && count($cats) ? ucfirst(str_replace('_', ' ', $cats[0])) : '';
            DB::table('products')
                ->where('id', $product->id)
                ->update(['categories' => $first]);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('category');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('categories', 'category');
        });
    }
};
