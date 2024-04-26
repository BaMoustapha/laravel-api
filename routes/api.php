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
// Route::post("/utilisateur/compte/deconnexion", [UserController:: class, "deconnexion"]);
Route::post('/utilisateur/deconnexion', [UserController::class, 'deconnexion']);
// suppression d'un compte utilisateur
Route::post('/utlisateur/suppression', [UserController::class, 'suppression']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::group(["middleware" => ["auth:sanctum"]], function () {
}) ;



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




// public function connexion(Request $request) {
//     $utilisateurDonnee = $request->validate([
//         "email" => ["required", "email"],
//         "password" => ["required", "string"]
//     ]);

//     $utilisateurs = User::where("email", '=', $request->email)->first();

//     if(!$utilisateurs) {
//         return response()->json([
//             'status' => 0,
//             'message' => "Aucun utilisateur trouvé avec l'email suivant: {$utilisateurDonnee['email']}"
//         ], 401);
//     }

//     if(!Hash::check($request->password, $utilisateurs->password)) {
//         return response()->json([
//             'status' => 0,
//             'message' => "Mot de passe incorrect"
//         ], 401);
//     }

//     $token = $utilisateurs->createToken("personel_acces_token")->accessToken;

//     return response()->json([
//         'status' => 1,
//         'message' => "Connexion réussie",
//         'access_token' => $token
//     ], 200);
// }