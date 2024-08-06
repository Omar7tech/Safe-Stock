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
        Schema::create('categories', function (Blueprint $table) {
            $table->id()->comment('Primary key');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name', 255)->comment('Category name');
            $table->text('description')->nullable()->comment('Category description');
            $table->timestamps();
            $table->softDeletes()->comment('Soft delete timestamp');
            $table->index('name', 'idx_categories_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
