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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('category_id');
            $table->tinyInteger('post_stat')->default(0);
            $table->string('post_cover');
            $table->string('post_title');
            $table->string('post_slug');
            $table->longText('post_desc');
            $table->string('post_keyword');
            $table->text('post_metadesc');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
