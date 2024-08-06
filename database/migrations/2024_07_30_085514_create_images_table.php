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
        Schema::create('product_images', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Foreign key to products table
            $table->string('image_path')->comment('Path to product image');
            $table->timestamps();
        });

        // Indexing
        Schema::table('product_images', function (Blueprint $table) {
            $table->index('product_id'); // Index on product_id for faster lookup
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
