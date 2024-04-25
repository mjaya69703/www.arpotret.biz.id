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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->integer('cproduct_id');
            $table->integer('product_id');
            $table->integer('author_id')->default(0);
            $table->string('gallery_name');
            $table->string('gallery_slug');
            $table->longText('gallery_desc');
            // $table->bigInteger('gallery_price');
            $table->string('gallery_cover');
            $table->string('gallery_image_1')->nullable();
            $table->string('gallery_image_2')->nullable();
            $table->string('gallery_image_3')->nullable();
            $table->string('gallery_image_4')->nullable();
            $table->string('gallery_image_5')->nullable();
            $table->string('gallery_image_6')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
