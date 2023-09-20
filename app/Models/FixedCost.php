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

    public static function getAllByUser($userId)
    {
        $fixedCosts = self::join("costs", "fixed_costs.cost_id", "=", "costs.id")
            ->where("costs.user_id", $userId)
            ->select(
                "fixed_costs.id",
                "end_date",
                "costs.user_id",
                "costs.type_id",
                "costs.name",
                "costs.cost",
                "costs.is_half_billing",
                "costs.is_full_billing"
            )
            ->get();
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