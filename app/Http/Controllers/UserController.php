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
      if(!$utilisateur) return response(["message" => "Aucun utilisateur de trouver avec l'email suivante $utilisateurDonnee[email]"], 401);
      if(!Hash::check($utilisateurDonnee["password"], $utilisateur->password)){
        return response(["message" => "Aucun utilisateur de trouver avec ce mot de passe"], 401);
      } 
      return $utilisateur;

    }
}
