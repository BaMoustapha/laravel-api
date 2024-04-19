<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function inscription(Request  $request){
        $utilisateurDonnee = $request->validate([
            "name" => ["required", "string", "min:2", "max:255"],
            "email" => ["required", "email", "unique:users,email"],
            "password" => ["required", "string"]
        ]);

        $utilisateurs = User::create([
            "name" => $utilisateurDonnee["name"],
            "email" => $utilisateurDonnee["email"],
            "password" => bcrypt($utilisateurDonnee["password"])
        ]);

        return response($utilisateurs, 201);
    }
}
