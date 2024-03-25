<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class AppUser extends Model
{
    use HasFactory;

    protected $connection = 'sqlite_app'; // Specify the connection
    protected $table = 'users'; // Ensure it matches the table name in migration
    protected $primaryKey = 'UserId'; // Specify the primary key explicitly
    public $incrementing = true; // Assuming your UserId auto-increments
    protected $fillable = ['Email', 'Password', 'Role', 'Status'];
    public $timestamps = false;

    public function setPasswordAttribute($password)
    {
        $this->attributes['Password'] = Hash::make($password);
    }
}
