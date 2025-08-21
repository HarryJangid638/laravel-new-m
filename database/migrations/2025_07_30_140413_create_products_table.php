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
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->decimal('regular_price', 10, 2);
            $table->decimal('promotional_price', 10, 2)->nullable();
            $table->string('currency', 8)->default('USD');
            $table->decimal('tax_rate', 5, 2)->default(0.00);
            $table->decimal('shipping_width', 8, 2)->nullable();
            $table->decimal('shipping_height', 8, 2)->nullable();
            $table->decimal('shipping_weight', 8, 2)->nullable();
            $table->decimal('shipping_fee', 10, 2)->nullable();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('sub_category_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
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
