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
            $table->integer('cproduct_id');
            $table->integer('author_id')->default(0);
            $table->string('product_name');
            $table->string('product_slug');
            $table->longText('product_desc');
            $table->bigInteger('product_price');
            $table->string('product_cover');
            $table->string('product_image_1')->nullable();
            $table->string('product_image_2')->nullable();
            $table->string('product_image_3')->nullable();
            $table->string('product_image_4')->nullable();
            $table->string('product_image_5')->nullable();
            $table->string('product_image_6')->nullable();
            $table->timestamps();
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
