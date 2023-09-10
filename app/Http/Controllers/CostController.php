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

    public function show(Request $request, $userId)
    {
        $year = $request->query('year');
        $month = $request->query('month');

        $costs = Cost::getAllByUser($year, $month, $userId);
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

    public function update(Request $reauest, $id)
    {
        $cost = Cost::updateCost($reauest, $id);
        return response()->json(
            $cost,
            200
        );
    }

    public function getMonthlyBillingAmount(Request $request)
    {
        $year = $request->query('year');
        $month = $request->query('month');

        $summaryCosts = Cost::getMonthlyBillingAmount($year, $month);

        $costs = array();
        foreach ($summaryCosts as $cost) {
            $id = $cost->user_id;
            if (!isset($costs[$id])) {
                $costs[$id] = array();
                $costs[$id]["half_billing"] = $cost->my_half_billing;
                $costs[$id]["full_billing"] = $cost->my_full_billing;
            }
        }

        return response()->json(
            $costs,
            200
        );
    }
}