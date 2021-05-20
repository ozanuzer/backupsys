<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatabaseUsers extends Model
{
    use HasFactory;
    protected $table = 'database_users';
}
