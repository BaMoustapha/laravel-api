<?php


use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/users', [AuthController::class, 'getAllUsers']);
// Route::post('/logout', [AuthController::class, 'logout']);
// Route::get('/me', [AuthController::class, 'me'] );
// Route::delete('/delete', [AuthController::class, 'delete'] );

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/update', [AuthController::class, 'update']);
    Route::delete('/user/delete', [AuthController::class, 'delete']);
});


// Route::group([
//     'middleware' => 'api',
//     'prefix' => 'auth'
// ], function ($router) {
//     Route::post('/register', [AuthController::class, 'register'])->name('register');
//     Route::post('/login', [AuthController::class, 'login'])->name('login');
//     Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
//     Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
//     Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
// });
use App\Http\controllers\UserController;

Route::get('/hello', function () {
    return "Hello World!";
});




use App\Http\Controllers\ShopController;

Route::middleware('auth:api')->group(function () {
    // Routes de boutique protégées
    Route::get('/shops', [ShopController::class, 'index']);
    Route::post('/shops', [ShopController::class, 'store']);
    Route::get('/shops/{id}', [ShopController::class, 'show']);
    Route::put('/shops/{id}', [ShopController::class, 'update']);
    Route::delete('/shops/{id}', [ShopController::class, 'destroy']);
});

use App\Http\Controllers\ProductController;


Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);


use App\Http\Controllers\CategoryController;


Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);


use App\Http\Controllers\MessageController;


Route::get('/messages', [MessageController::class, 'index']);
Route::post('/messages', [MessageController::class, 'store']);
Route::get('/messages/{id}', [MessageController::class, 'show']);
Route::delete('/messages/{id}', [MessageController::class, 'destroy']);

