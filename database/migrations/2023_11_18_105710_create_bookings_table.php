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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('book_client_name')->nullable();
            $table->string('book_client_email')->nullable();
            $table->string('book_client_phone')->nullable();
            $table->bigInteger('book_product_id');
            $table->bigInteger('book_author_id')->default(0);
            $table->bigInteger('book_assign_to')->default(0)->nullable();
            $table->integer('book_stat')->default(0);
            $table->string('book_code');
            $table->string('book_date');
            $table->string('book_time');
            $table->string('book_note');
            $table->string('book_locate');
            $table->string('book_payment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
