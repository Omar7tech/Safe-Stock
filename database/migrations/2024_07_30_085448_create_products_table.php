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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Foreign key to categories table
            $table->foreignId('supplier_id')->nullable()->constrained()->onDelete('set null'); // Foreign key to suppliers table, nullable
            $table->string('name', 255)->index()->comment('Product name'); // Indexed for faster searches
            $table->text('description')->nullable()->comment('Product description');
            $table->decimal('price', 8, 2)->index()->comment('Product price'); // Indexed for faster searches
            $table->integer('stock_quantity')->default(0)->comment('Quantity in stock');
            $table->string('sku')->unique()->comment('Stock Keeping Unit, unique identifier');
            $table->boolean('is_active')->default(true)->comment('Product active status');
            $table->timestamps();
            $table->softDeletes()->comment('Soft delete timestamp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
