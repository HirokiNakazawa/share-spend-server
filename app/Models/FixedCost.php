<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Cost;

class FixedCost extends Model
{
    use HasFactory;

    protected $fillable = [
        'cost_id',
        'end_date'
    ];

    public static function getAll()
    {
        $fixedCosts = self::all();
        return $fixedCosts;
    }

    public static function createFixedCost($data)
    {
        $createCostData = $data->except("end_date");
        $cost = Cost::create($createCostData);

        $id = $cost->id;
        $fixedCostData = array(
            "cost_id" => $id,
            "end_date" => $data->end_date
        );
        $fixedCost = self::create($fixedCostData);
        return $fixedCost;
    }
}