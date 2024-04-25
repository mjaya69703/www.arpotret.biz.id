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
        Schema::create('web_settings', function (Blueprint $table) {
            $table->id();
            // IMAGE SECTION
            $table->string('slider_1')->default('slider_1.jpg');
            $table->string('slider_2')->default('slider_2.jpg');
            $table->string('slider_3')->default('slider_3.jpg');
            $table->string('slider_4')->default('slider_4.jpg');
            $table->string('slider_5')->default('slider_5.jpg');
            $table->string('site_qris')->default('site_qris.png');
            $table->string('site_logo')->default('site_logo.png');
            // SITE DESCRIPTION
            $table->string('site_head'); // HEAD TITLE PADA SLIDER
            $table->string('site_desc'); // DESC TITLE PADA SLIDER
            $table->string('site_name'); // NAMA SITUS
            $table->string('site_team'); // NAMA SITUS
            $table->string('site_link'); // URL SITUS

            // ADDRESS SITE
            $table->string('site_street'); // NAMA JALAN
            $table->string('site_poscod'); // NAMA KODEPOS / REGION
            $table->text('site_locate'); // EMBED LINK GOOGLE MAPS

            // CONTACT SITE
            $table->string('site_email');
            $table->string('site_phone');

            // SOCIAL LINKS
            $table->string('site_social_fb')->nullable();
            $table->string('site_social_ig')->nullable();
            $table->string('site_social_in')->nullable();
            $table->string('site_social_tw')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_settings');
    }
};
