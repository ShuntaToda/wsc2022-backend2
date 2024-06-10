<?php

use App\Http\Controllers\api\GameController as ApiGameController;
use App\Http\Controllers\api\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::prefix('v1')->group(function () {
    Route::middleware("auth:sanctum")->group(function () {
        Route::prefix("auth")->group(function () {
            Route::post('signout', [LoginController::class, "signout"]);
        });
    });
    Route::prefix("auth")->group(function () {
        Route::post('signup', [LoginController::class, "signup"]);
        Route::post('signin', [LoginController::class, "signin"]);
    });

    Route::get("games", [ApiGameController::class, "index"]);
});
