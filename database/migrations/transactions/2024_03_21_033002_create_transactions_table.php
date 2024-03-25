<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::connection('sqlite_transactions')->create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('vendor');
            $table->float('withdraw')->nullable();
            $table->float('deposit')->nullable();
            $table->float('balance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
