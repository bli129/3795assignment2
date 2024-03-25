<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::connection('sqlite_app')->create('users', function (Blueprint $table) {
            $table->id('UserId');
            $table->string('Email', 80);
            $table->string('Password', 200);
            $table->string('Role', 20);
            $table->integer('Status');
        });

        // Inserting admin user
        DB::connection('sqlite_app')->table('users')->insert([
            'Email' => 'aa@aa.aa',
            'Password' => Hash::make('P@$$w0rd'),
            'Role' => 'admin',
            'Status' => 1, // Assuming 1 indicates an active user
        ]);

        DB::connection('sqlite_app')->table('users')->insert([
            'Email' => 'gary@dawes.com',
            'Password' => Hash::make('123'),
            'Role' => 'user',
            'Status' => 1,
        ]);
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
