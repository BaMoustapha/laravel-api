<?php
use App\Http\controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::get('/users', [UserController::class, 'getAllUsers']);
Route::get('/users/{id}', [UserController::class, 'getUsers']);
Route::post("/utilisateur/inscription", [UserController:: class, "inscription"]);
Route::post("/utilisateur/connexion", [UserController:: class, "connexion"]);
// modifier un utilisateur
Route::put('/users/{id}', [UserController::class, 'updateUser']);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::group(["middleware" => ["auth:sanctum"]], function () {
}) ;

Route::post("/utilisateur/compte/deconnexion", [UserController:: class, "deconnexion"]);


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