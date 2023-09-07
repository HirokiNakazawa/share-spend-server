<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Type;

class TypeController extends Controller
{
    public function index()
    {
        $typeList = Type::getAll();

        $types = array();
        foreach ($typeList as $type) {
            if (!isset($types[$type["id"]])) {
                $types[$type["id"]] = $type["type"];
            }
        }

        return response()->json(
            $types,
            200
        );
    }

    public function store(Request $request)
    {
        $type = Type::createType($request);
        return response()->json(
            $type,
            200
        );
    }
}