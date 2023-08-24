<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Type;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::getAll();
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