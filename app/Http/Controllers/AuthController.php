<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;


class AuthController extends Controller
{

    public function getAllUsers()
    {
        $users = User::all();
        return response()->json($users, 200);
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:users',
            'telephone' => 'required',
            'adresse' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'password' => bcrypt($request->password),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(['token' => $token, 'user' => $user]);
    }




    public function login(Request $request)
    {
        if (!$token = Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    public function me()
    {
        return response()->json(Auth::user());
    }

    public function logout(Request $request)
    {
        try {

            $token = JWTAuth::getToken();

            // Invalider le token
            if ($token) {
                JWTAuth::invalidate($token);
            }
            // Déconnecte l'utilisateur
            Auth::logout();

            return response()->json(['message' => 'Déconnecté avec succès']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la déconnexion'], 500);
        }
    }

    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 1440,
            'user' => Auth::user()
        ]);
    }


    public function delete(Request $request)
{
    // Récupérer l'utilisateur actuellement authentifié
    $user = Auth::user();

    // Vérifier si l'utilisateur existe
    if ($user) {
        // Récupérer le token JWT de la requête
        $token = JWTAuth::getToken();

        // Invalider le token
        if ($token) {
            JWTAuth::invalidate($token);
        }

        // Supprimer l'utilisateur
        $user->delete();

        return response()->json(['message' => 'Utilisateur supprimé avec succès']);
    } else {
        return response()->json(['message' => 'Utilisateur non trouvé'], 404);
    }
}
    public function update(Request $request)
{
    $user = Auth::user();

    if ($user) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:users',
            'telephone' => 'required',
            'adresse' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        // Mettre à jour l'utilisateur
        $user->update($validator->validated());

        return response()->json(['message' => 'Utilisateur mis à jour avec succès', 'user' => $user]);
    } else {
        return response()->json(['message' => 'Utilisateur non trouvé'], 404);
    }
}

}


// {

//     /**
//      * Register a User.
//      *
//      * @return \Illuminate\Http\JsonResponse
//      */
//     public function register() {
//         $validator = Validator::make(request()->all(), [
//             "name" => ["required", "string", "min:2", "max:255"],
//             "prenom" => ["required", "string"],
//             "email" => ["required", "email", "unique:users,email"],
//             "password" => ["required", "string"],
//             "adresse" => ["required", "String"],
//             "telephone" => ["required", "numeric"],
//         ]);

//         if($validator->fails()){
//             return response()->json($validator->errors()->toJson(), 400);
//         }

//         $user = new User;
//         $user->name = request()->name;
//         $user->prenom = request()->prenom;
//         $user->email = request()->email;
//         $user->password = bcrypt(request()->password);
//         $user->telephone = request()->telephone;
//         $user->adresse = request()->adresse;
//         $user->save();

//         return response()->json($user, 201);
//     }


//     /**
//      * Get a JWT via given credentials.
//      *
//      * @return \Illuminate\Http\JsonResponse
//      */
//     public function login()
//     {
//         $credentials = request(['email', 'password']);

//         if (! $token = auth()->attempt($credentials)) {
//             return response()->json(['error' => 'Unauthorized'], 401);
//         }

//         return $this->respondWithToken($token);
//     }

//     /**
//      * Get the authenticated User.
//      *
//      * @return \Illuminate\Http\JsonResponse
//      */
//     public function me()
//     {
//         return response()->json(auth()->user());
//     }

//     /**
//      * Log the user out (Invalidate the token).
//      *
//      * @return \Illuminate\Http\JsonResponse
//      */
//     public function logout()
//     {
//         auth()->logout();

//         return response()->json(['message' => 'Successfully logged out']);
//     }

//     /**
//      * Refresh a token.
//      *
//      * @return \Illuminate\Http\JsonResponse
//      */
//     public function refresh()
//     {
//         return $this->respondWithToken(auth()->refresh());
//     }

//     /**
//      * Get the token array structure.
//      *
//      * @param  string $token
//      *
//      * @return \Illuminate\Http\JsonResponse
//      */
//     protected function respondWithToken($token)
//     {
//         return response()->json([
//             'access_token' => $token,
//             'token_type' => 'bearer',
//             'expires_in' => auth()->factory()->getTTL() * 60
//         ]);
//     }
// }
