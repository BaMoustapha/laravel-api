<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


use App\Http\Controllers\ShopController;

Route::get('/shops', [ShopController::class, 'index']);
Route::get('/shops/create', [ShopController::class, 'create']);
Route::post('/shops', [ShopController::class, 'store']);
Route::get('/shops/{id}', [ShopController::class, 'show']);
Route::get('/shops/{id}/edit', [ShopController::class, 'edit']);
Route::put('/shops/{id}', [ShopController::class, 'update']);
Route::delete('/shops/{id}', [ShopController::class, 'destroy']);

Route::get('/hello', function () {
    return "Hello World!";
});