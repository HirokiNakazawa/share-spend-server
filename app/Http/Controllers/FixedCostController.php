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
}