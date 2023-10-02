<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AppUserController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\CostController;
use App\Http\Controllers\FixedCostController;

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
Route::get('/costs/all', [CostController::class, 'showMonthlyCost']);
Route::get('/costs/type', [CostController::class, 'showMonthlyCostByType']);
Route::get('/costs/{userId}', [CostController::class, 'show']);
Route::post('/costs/create', [CostController::class, 'store']);
Route::put('/costs/update/{id}', [CostController::class, 'update']);

Route::get('/fixed-costs', [FixedCostController::class, 'index']);
Route::get('/fixed-costs/{userId}', [FixedCostController::class, 'show']);
Route::post('/fixed-costs/create', [FixedCostController::class, 'store']);
Route::put('/fixed-costs/update/{costId}', [FixedCostController::class, 'update']);

Route::get('/billing-amount', [CostController::class, 'getMonthlyBillingAmount']);