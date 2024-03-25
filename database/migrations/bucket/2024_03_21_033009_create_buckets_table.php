<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('buckets', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('category');
            $table->string('vendor');
            $table->unique(['category', 'vendor']); // Enforce unique combination
        });

        // Predefined buckets
        $predefinedBuckets = [
            ['Entertainment', 'ST JAMES RESTAURAT'],
            ['Entertainment', 'PUR & SIMPLE RESTAUR'],
            ['Entertainment', 'Subway'],
            ['Entertainment', 'WHITE SPOT RESTAURAN'],
            ['Entertainment', 'MCDONALDS'],
            ['Entertainment', 'TIM HORTONS'],
            ['Groceries', 'SAFEWAY'],
            ['Groceries', 'SAFEWAY #4913'],
            ['Groceries', 'REAL CDN SUPERS'],
            ['Groceries', 'WALMART STORE'],
            ['Groceries', 'COSTCO WHOLESAL'],
            ['Groceries', '7-ELEVEN STORE'],
            ['Communication', 'ROGERS MOBILE'],
            ['Car Insurance', 'ICBC'],
            ['Gas Heating', 'FORTISBC'],
            ['Donations', 'RED CROSS'],
            ['Banking', 'GATEWAY'],
            ['Banking', 'CHQ'],
            ['Banking', 'FEE'],
        ];

        foreach ($predefinedBuckets as $bucket) {
            DB::table('buckets')->insert([
                'category' => $bucket[0],
                'vendor' => $bucket[1]
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buckets');
    }
};
