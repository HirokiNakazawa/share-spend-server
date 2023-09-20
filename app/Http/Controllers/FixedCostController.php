<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FixedCost;

class FixedCostController extends Controller
{
    public function index()
    {
        $fixedCosts = FixedCost::getAll();
        return response()->json(
            $fixedCosts,
            200
        );
    }

    public function show($userId)
    {
        $fixedCosts = FixedCost::getAllByUser($userId);
        return response()->json(
            $fixedCosts,
            200
        );
    }

    public function store(Request $request)
    {
        $fixedCost = FixedCost::createFixedCost($request);
        return response()->json(
            $fixedCost,
            200
        );
    }
}