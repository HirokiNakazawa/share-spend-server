<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AppUser;

class AppUserController extends Controller
{
    public function register(Request $request)
    {
        $appUser = AppUser::createUser($request);
        return response()->json(
            $appUser,
            201
        );
    }

    public function login(Request $request)
    {
        $appUser = AppUser::login($request);
        if ($appUser) {
            return response()->json(
                $appUser,
                200
            );
        } else {
            return response()->json(
                "Login Error",
                401
            );
        }
    }
}