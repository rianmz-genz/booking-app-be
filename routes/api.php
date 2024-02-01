<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StadiumController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StadiumCategoryController;

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

Route::prefix('/stadiums')->group(function () {
    Route::get('', [StadiumController::class, 'getAll']);
});


Route::prefix('/auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::prefix('/stadium-categories')->group(function () {
    Route::get('', [StadiumCategoryController::class, 'index']);
    Route::get('/{id}', [StadiumCategoryController::class, 'show']);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('/stadiums')->group(function () {
        Route::post('', [StadiumController::class, 'create']);
        Route::post('/{id}', [StadiumController::class, 'update']);
        Route::delete('/{id}', [StadiumController::class, 'delete']);
    });

    Route::prefix('/stadium-categories')->group(function () {
        Route::post('', [StadiumCategoryController::class, 'store']);
        Route::put('/{id}', [StadiumCategoryController::class, 'update']);
        Route::delete('/{id}', [StadiumCategoryController::class, 'destroy']);
    });
});