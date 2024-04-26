<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function inscription(Request  $request){
        $utilisateurDonnee = $request->validate([
            "name" => ["required", "string", "min:2", "max:255"],
            "prenom" => ["required", "string"],
            "email" => ["required", "email", "unique:users,email"],
            "password" => ["required", "string"],
            "adresse" => ["required", "String"],
            "telephone" => ["required", "numeric"],
        ]);

        $utilisateurs = User::create([
            "name" => $utilisateurDonnee["name"],
            "prenom" => $utilisateurDonnee["prenom"],
            "adresse" => $utilisateurDonnee["adresse"],
            "telephone" => $utilisateurDonnee["telephone"],
            "email" => $utilisateurDonnee["email"],
            "password" => bcrypt($utilisateurDonnee["password"])
        ]);

        return response($utilisateurs, 201);
    }

    public function connexion(Request $request) {
        $utilisateurDonnee = $request->validate([
            "email" => ["required", "email"],
            "password" => ["required", "string"]
        ]);
      $utilisateur = User::where("email", $utilisateurDonnee["email"])->first();
      if(!$utilisateur) 
      return response(["message" => "Aucun utilisateur de trouver avec l'email suivante $utilisateurDonnee[email]"], 401);
      if(!Hash::check($utilisateurDonnee["password"], $utilisateur->password)){
        return response(["message" => "Aucun utilisateur de trouver avec ce mot de passe"], 401);
      } 
        // return $utilisateur;
      
      $token = $utilisateur->createToken("personal_access_tokens")->accessToken;
      return response([
        "utilisateur" => $utilisateur,
        "token" => $token
      ], 200);

    }

    public function deconnexion(Request $request) {
       auth()->logout();
            return response(["message" => "Déconnexion réussie"], 200);
        } 
        // return response(["message" => "Déconnexion réussie"], 200);

    // public function deconnexion() {
    //     return auth()->user()->tokens->each(function($token, $key) {
    //         $tokens->delete();
    //     });
    //     return response(["message" => "deconnexion"], 200);

    // }
     
// deconnexion d'un compte
    // public function deconnexion() {
    //     if (user()->check()) {
    //         user()->user()->tokens->each(function($token, $key) {

    //         });
    //         return response(["message" => "Deconnexion"], 200);
    //     } else {
    //         return response(["message" => "Aucun utilisateur connecté"], 404);
    //     }
    //     // return auth()->user()->token->each(function($token, $key) {
    //     //     $token->delete();
    //     // });
    // }

    // public function deconnexion(Request $request) {
    //     // Vérifiez si l'utilisateur est authentifié
    //     if (auth()->check()) {
    //         // Supprimez tous les tokens d'authentification de l'utilisateur
    //         $request->user()->tokens()->delete();
    //         return response()->json(['message' => 'Déconnexion réussie'], 200);
    //     } else {
    //         return response()->json(['message' => 'Aucun utilisateur connecté'], 404);
    //     }
    // }
    

    // public function deconnexion() {
    //     if (auth()->check()) {
    //         user()->user()->tokens->each(function($token, $key) {
    //             $token->delete();
    //         });
    //         return response(["message" => "Déconnexion réussie"], 200);
    //     } else {
    //             return response(["message" => "Aucun utilisateur connecté"], 404);
    //     }
    // }
    
        // else {
        //     return response(["message" => "Déconnexion réussie"], 200);
        // }
    
    

    // recuper tous les utilisateurs
    public function getAllUsers()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    // recupere un utilisateur par son ID

        public function getUsers($id)
    {
        // Trouver l'utilisateur par son ID
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Utilisateur n\'existe pas'], 404);
        }

        // Retourner l'utilisateur trouvé
        return response()->json($user, 200);
    }
    // public function show($id)
    // {
    //     $shop = Shop::find($id);

    //     if (!$shop) {
    //         return response()->json(['error' => 'Shop not found'], 404);
    //     }

    //     return response()->json($shop, 200);
    // }

     // Méthode pour modifier un utilisateur
     public function updateUser(Request $request, $id)
     {
         // Valider les données de la requête
         $request->validate([
             'name' => 'required|string|max:255',
             'prenom' => 'required|string|max:255',
             'email' => 'required|email|unique:users,email,'.$id,
             'adresse' => 'required|string',
             'telephone' => 'required|numeric',
         ]);
 
         // Trouver l'utilisateur à modifier
         $user = User::findOrFail($id);
 
         // Mettre à jour les données de l'utilisateur
         $user->update($request->all());
 
         return response()->json($user, 200);
     }
}
