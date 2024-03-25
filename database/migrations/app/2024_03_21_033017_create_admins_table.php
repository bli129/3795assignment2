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
        Schema::connection('sqlite_app')->create('admins', function (Blueprint $table) {
            $table->id('AdminId');
            $table->string('Email', 80);
            $table->string('Password', 200);
            $table->string('Role', 20);
        });

        // Insert default admin user
        DB::connection('sqlite_app')->table('admins')->insert([
            'Email' => 'aa@aa.aa',
            'Password' => Hash::make('P@$$w0rd'), // Hash the password
            'Role' => 'admin', // Assuming you have a role you want to assign
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
