<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cost;

class CostController extends Controller
{
    public function index()
    {
        $costs = Cost::getAll();
        return response()->json(
            $costs,
            200
        );
    }

    public function showMonthlyCost(Request $request)
    {
        $year = $request->query('year');
        $month = $request->query('month');

        $costs = Cost::getMonthlyCost($year, $month);
        return response()->json(
            $costs,
            200
        );
    }

    public function showMonthlyCostByType(Request $request)
    {
        $year = $request->query('year');
        $month = $request->query('month');

        $costs = Cost::getMonthlyCostByType($year, $month);
        return response()->json(
            $costs,
            200
        );
    }

    public function store(Request $request)
    {
        $cost = Cost::createCost($request);
        return response()->json(
            $cost,
            200
        );
    }
}