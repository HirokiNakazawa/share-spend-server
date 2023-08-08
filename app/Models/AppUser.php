<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppUser extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'password'
    ];

    public static function createUser($data)
    {
        return self::create($data);
    }
}