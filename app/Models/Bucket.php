<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bucket extends Model
{
    protected $connection = 'sqlite_bucket';

    protected $primaryKey = 'id'; // Assuming 'id' is the unique identifier
    public $incrementing = true;
    protected $fillable = ['category', 'vendor'];
    public $timestamps = false;
}

