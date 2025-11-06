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
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 15, 2); // Support harga hingga 999,999,999,999.99
            $table->integer('discount')->default(0)->comment('Discount in percentage (0-100)');
            $table->integer('stock')->default(0); // Added default value
            $table->string('image')->nullable()->comment('Path to product image');
            $table->json('specifications')->nullable()->comment('Product specifications as JSON array');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Indexes untuk performa query
            $table->index('category_id');
            $table->index('slug');
            $table->index('is_active');
            $table->index('created_at');
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
