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
        Schema::create('page_managers', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('page_id')->nullable(); // JIKA PILIH SUBMENU
            $table->tinyInteger('page_type');
            // 0 : Header ; 1 : Menu ; 2 Sub Menu
            $table->tinyInteger('page_role')->nullable();
            $table->tinyInteger('page_menu')->nullable()->default(0);
            // 0 : Super Admin; 1 : General Admin; 2 : General Author
            $table->string('page_font')->nullable();
            $table->string('page_name');
            $table->string('page_desc');
            $table->string('page_link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_managers');
    }
};
