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
        Schema::create('contact_mes', function (Blueprint $table) {
            $table->id();
            $table->integer('contact_sendto')->default(0);
            $table->tinyInteger('contact_type')->default(0);
            // TYPE 0 = INBOX; TYPE 2 = REPLY
            $table->string('contact_codr')->nullable();
            // GATEWAY TO REPLY MESSAGE
            $table->string('contact_code')->unique();
            // RANDOM CODE
            $table->string('contact_send')->nullable();
            $table->string('contact_name');
            $table->string('contact_mail');
            $table->string('contact_subject');
            $table->longText('contact_message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_mes');
    }
};
