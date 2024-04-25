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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('region_kelurahan')->nullable();
            $table->string('region_kecamatan')->nullable();
            $table->string('region_kota')->nullable();
            $table->string('region_provinsi')->nullable();
            $table->string('photo')->default('default.jpg');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('verify_token')->nullable();
            $table->tinyInteger('type')->default(0);
            $table->timestamp('token_created_at')->nullable(); // new column
            $table->boolean('is_verified')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
