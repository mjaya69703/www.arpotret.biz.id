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
        Schema::create('connects', function (Blueprint $table) {
            $table->id();
            $table->integer('book_id');
            $table->integer('admin_id')->nullable();
            $table->integer('users_id')->nullable();
            $table->integer('send_to'); // DARI BOOK ID
            $table->integer('connect_type')->default(0);
            $table->integer('connect_stat')->default(0);
            $table->string('connect_code')->nullable()->unique(); // DARI BOOK ID
            $table->string('connect_codr')->nullable();
            $table->string('connect_core')->nullable()->unique();
            $table->longText('connect_subject');
            $table->longText('connect_message');
            $table->string('connect_attach_1')->nullable();
            $table->string('connect_attach_2')->nullable();
            $table->string('connect_attach_3')->nullable();
            $table->string('connect_attach_4')->nullable();
            $table->string('connect_attach_5')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('connects');
    }
};
