<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 15, 2);
            $table->unsignedInteger('stock')->default(0);
            $table->string('category')->index();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
            $table->softDeletes(); // Allows "trash" / recovery instead of hard delete
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
