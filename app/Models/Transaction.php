<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $connection = 'sqlite_transactions';
    protected $table = 'transactions';
    protected $fillable = ['date', 'vendor', 'withdraw', 'deposit', 'balance'];

    public $timestamps = false;
}
