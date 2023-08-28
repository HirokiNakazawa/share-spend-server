<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type_id',
        'name',
        'cost',
        'is_half_billing',
        'is_full_billing'
    ];

    public static function getAll()
    {
        $costs = self::all();
        return $costs;
    }

    public static function getMonthlyCostyType($year, $month)
    {
        $costs = self::selectRaw("type_id, SUM(cost) as total_cost")
            ->whereYear("created_at", $year)
            ->whereMonth("created_at", $month)
            ->groupBy("type_id")
            ->get();
        return $costs;
    }

    public static function createCost($data)
    {
        $cost = self::create($data->all());
        return self::select("name", "cost")->find($cost->id);
    }
}