<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function getAllByUser($year, $month, $userId)
    {
        $costs = self::whereYear("created_at", $year)
            ->whereMonth("created_at", $month)
            ->where("user_id", $userId)
            ->get();
        return $costs;
    }

    public static function getMonthlyCost($year, $month)
    {
        $costs = self::whereYear("created_at", $year)
            ->whereMonth("created_at", $month)
            ->get();
        return $costs;
    }

    public static function getMonthlyCostByType($year, $month)
    {
        $costs = self::join("types", "costs.type_id", "=", "types.id")
            ->whereYear("costs.created_at", $year)
            ->whereMonth("costs.created_at", $month)
            ->selectRaw("costs.type_id, types.type as type_name, CAST(SUM(costs.cost) AS SIGNED) as total_cost")
            ->groupBy("costs.type_id")
            ->orderBy("total_cost", "desc")
            ->get();

        return $costs;
    }

    public static function createCost($data)
    {
        $cost = self::create($data->all());
        return self::select("name", "cost")->find($cost->id);
    }

    public static function updateCost($data, $id)
    {
        $cost = self::findOrFail($id);
        $cost->update($data->all());
        return $cost;
    }

    public static function getMonthlyBillingAmount($year, $month)
    {
        $summaryCosts = DB::table('costs')
            ->select(
                'user_id',
                DB::raw('SUM(CASE WHEN is_half_billing = 1 THEN cost / 2 ELSE 0 END) AS my_half_billing'),
                DB::raw('SUM(CASE WHEN is_full_billing = 1 THEN cost ELSE 0 END) AS my_full_billing')
            )
            ->whereIn('user_id', [1, 2])
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->groupBy('user_id')
            ->get();

        return $summaryCosts;
    }
}