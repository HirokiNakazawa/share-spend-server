<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'type'
    ];

    public static function getAll()
    {
        $types = self::all();
        return $types;
    }

    public static function createType($data)
    {
        $type = self::create($data->all());
        return self::select("type")->find($type->id);
    }
}