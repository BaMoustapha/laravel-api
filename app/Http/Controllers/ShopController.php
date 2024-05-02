<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // Autres méthodes omises pour la brièveté

    /**
     * Affiche la liste de toutes les boutiques.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::all();
        return response()->json($shops, 200);
    }

    /**
     * Enregistre une nouvelle boutique.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          // Vérifier si l'utilisateur est connecté
          if (!Auth::check()) {
            return response()->json(['error' => 'Vous devez être connecté pour créer une boutique'], 401);
        }

        // Créer la boutique
        $shop = new Shop();
        $shop->user_id = Auth::user()->id; // Assigner l'ID de l'utilisateur connecté à la boutique
        // Autres attributs de la boutique...
        $shop->save();

        return response()->json(['message' => 'Boutique créée avec succès'], 201);
    

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|max:255',
            'banniere' => 'nullable|image|max:255',
            'telephone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'adresse' => 'nullable|string|max:255',
            'a_propos' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id'
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = Storage::disk('public')->put('images/posts/logo-images', $request->file('logo'));
        }

        $bannierePath = null;
        if ($request->hasFile('banniere')) {
            $bannierePath = Storage::disk('public')->put('images/posts/banniere-images', $request->file('banniere'));
        }

        $shop = Shop::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'logo' => $logoPath,
            'banniere' => $bannierePath,
            'telephone' => $request->input('telephone'),
            'email' => $request->input('email'),
            'adresse' => $request->input('adresse'),
            'a_propos' => $request->input('a_propos'),
            'user_id' => $request->input('user_id')
        ]);

        return response()->json($shop, 201);
    }

    /**
     * Affiche les détails d'une boutique spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shop = Shop::findOrFail($id);
        return response()->json($shop, 200);
    }

    /**
     * Met à jour les informations d'une boutique spécifique.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
  $shop = Shop::findOrFail($id);

  $request->validate([
    'name' => 'required|string|max:255',
    'description' => 'nullable|string',
    'user_id' => 'nullable|exists:users,id',
    'logo' => 'nullable|image|max:255',
    'banniere' => 'nullable|image|max:255',
    'telephone' => 'nullable|string|max:255',
    'email' => 'nullable|email|max:255',
    'adresse' => 'nullable|string|max:255',
    'a_propos' => 'nullable|string'
  ]);

  $shop->update($request->all());

  // Fetch the updated shop data from the database (important!)
  $updatedShop = Shop::findOrFail($id);

  return response()->json($updatedShop, 200);
}

    /**
     * Supprime une boutique spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shop = Shop::findOrFail($id);
        $shop->delete();

        return response()->json(null, 204);
    }
}
