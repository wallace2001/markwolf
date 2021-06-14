<?php

use App\Http\Controllers\Product\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/createproduct", [ProductController::class, 'store']);
Route::patch("/updateproduct/{id}", [ProductController::class, 'update']);
Route::delete("/deleteproduct/{id}", [ProductController::class, 'destroy']);
