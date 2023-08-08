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
        $user = self::create($data->all());
        return self::select('id', 'name')->find($user->id);
    }

    public static function login($data)
    {
        return self::where('name', $data->name)
            ->where('password', $data->password)
            ->select('id', 'name')
            ->first();
    }
}