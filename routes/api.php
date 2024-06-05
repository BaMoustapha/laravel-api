<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/users', [AuthController::class, 'getAllUsers']);

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/update', [AuthController::class, 'update']);
    Route::delete('/user/delete', [AuthController::class, 'delete']);
});


use App\Http\controllers\UserController;

Route::get('/hello', function () {
    return "Hello World!";
});




use App\Http\Controllers\ShopController;

// Route::get('/user/shops', [ShopController::class, 'userShops']);
Route::get('/shops/{id}', [ShopController::class, 'show']);
Route::post('/shops/{id}', [ShopController::class, 'update']);
Route::delete('/shops/{id}', [ShopController::class, 'destroy']);
Route::get('/shops/{id}', [ShopController::class, 'show']);

Route::get('/shops', [ShopController::class, 'index']);
Route::get('/shops/name/{name}', [ShopController::class, 'showByName']);
Route::middleware('auth:api')->group(function () {



    Route::post('/shops', [ShopController::class, 'store']);
    Route::get('/shops', [ShopController::class, 'index']);
    Route::get('/user/shops', [ShopController::class, 'userShops']);
    Route::get('shops/user/{id}', [ShopController::class, 'checkUserShop']);
    // Routes de boutique protégées
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

// Endpoint des Messages
Route::get('/messages', [MessageController::class, 'index']);
Route::post('/messages', [MessageController::class, 'store']);
Route::get('/messages/{id}', [MessageController::class, 'show']);
Route::delete('/messages/{id}', [MessageController::class, 'destroy']);

// Endpoint des Commandes 
use App\Http\Controllers\CommandeController;

Route::get('/commandes', [CommandeController::class, 'index']);
Route::post('/commandes', [CommandeController::class, 'store']);
Route::get('/commandes/{id}', [CommandeController::class, 'show']);
Route::put('/commandes/{id}', [CommandeController::class, 'update']);
Route::delete('/commandes/{id}', [CommandeController::class, 'destroy']);


Route::post('/shops/{shopId}/categories', [ShopController::class, 'addCategoriesToShop']);
Route::get('/shops/{shopId}', [ShopController::class, 'getShopWithCategories']);
Route::get('/shops/{shopId}/categories',[ShopController::class, 'getShopCategories']);
