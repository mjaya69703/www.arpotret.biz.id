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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('biography')->nullable();
            $table->string('birthday_city')->nullable();
            $table->date('birthday_date')->nullable();
            $table->string('social_ig')->nullable();
            $table->string('social_fb')->nullable();
            $table->string('social_tw')->nullable();
            $table->string('social_in')->nullable();
            $table->string('region_address_1')->nullable();
            $table->string('region_address_2')->nullable();
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
            $table->tinyInteger('type')->default(1);
            // TYPE 1 = GENERAL ADMIN ; TYPE 2 = GENERAL FOTOGRAFER
            $table->timestamp('token_created_at')->nullable(); // new column
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
