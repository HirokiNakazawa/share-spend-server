<?php

namespace App\Http\Controllers;

use DateTime;
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
        if (!isset($request["registration_date"])) {
            $date = new DateTime();
            $registration_date = $date->format("Y-m-d");
            $request->merge(["registration_date" => $registration_date]);
        }
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

        if (count($summaryCosts) == 2) {
            $claim = $summaryCosts[0]->total_billing - $summaryCosts[1]->total_billing;
            $response = array(
                "sender" => $summaryCosts[1]->name,
                "receiver" => $summaryCosts[0]->name,
                "claim" => $claim
            );
        } elseif (count($summaryCosts) == 0) {
            return response()->json(
                array("message" => "データが登録されていません"),
                200
            );
        } elseif (count($summaryCosts) >= 2) {
            return response()->json(
                "ユーザーが3名以上存在しています",
                500
            );
        } else {
            $claim = $summaryCosts[0]->total_billing - 0;
            $response = array(
                "sender" => "",
                "receiver" => $summaryCosts[0]->name,
                "claim" => $claim
            );
        }

        return response()->json(
            $response,
            200
        );
    }
}