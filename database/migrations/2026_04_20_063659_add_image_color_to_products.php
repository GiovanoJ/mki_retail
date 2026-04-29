<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Image
            $table->string('image_path')->nullable()->after('description');

            // Colors: JSON array of { hex: '#ff0000', name: 'Merah' }
            $table->json('colors')->nullable()->after('image_path');

            // Specifications: JSON array of { key: 'Bahan', value: 'Katun' }
            $table->json('specifications')->nullable()->after('colors');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['image_path', 'colors', 'specifications']);
        });
    }
};
