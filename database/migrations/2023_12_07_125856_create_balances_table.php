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
        Schema::create('balances', function (Blueprint $table) {
            $table->id();
            $table->integer('bal_admin_id'); // ADMIN ID
            $table->string('bal_ucode')->unique(); // SOURCE CODE BALANCE
            $table->bigInteger('bal_value'); // VALUE NILAI BALANCE
            $table->integer('bal_type')->default(0); // TIPE BALANCE 0 => Balance Pending; 1 => Balance Income; 2 => Balance Outcome
            $table->string('bal_desc'); // DESCRIPTION BALANCE SOURCE OR DESCRIPTION
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balances');
    }
};
