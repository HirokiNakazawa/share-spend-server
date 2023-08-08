<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AppUser;

class AppUserController extends Controller
{
    public function register(Request $request)
    {
        $appUser = AppUser::createUser($request->all());
        return response()->json(
            $appUser,
            201
        );
    }
}