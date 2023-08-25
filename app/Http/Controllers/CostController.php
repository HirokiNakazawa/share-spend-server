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

    public function store(Request $request)
    {
        $cost = Cost::createCost($request);
        return response()->json(
            $cost,
            200
        );
    }
}