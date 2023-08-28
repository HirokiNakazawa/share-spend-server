<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AppUserController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\CostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AppUserController::class, 'register']);
Route::post('/login', [AppUserController::class, 'login']);

Route::get('/types', [TypeController::class, 'index']);
Route::post('/types/create', [TypeController::class, 'store']);

Route::get('/costs', [CostController::class, 'index']);
Route::get('/costs/type', [CostController::class, 'showMonthlyCostByType']);
Route::post('/costs/create', [CostController::class, 'store']);