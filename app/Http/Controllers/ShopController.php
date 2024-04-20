<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Affiche la liste des boutiques.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::all();
        return response()->json($shops);
    }

    /**
     * Enregistre une nouvelle boutique.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|string|max:255',
            'banniere' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'adresse' => 'nullable|string|max:255',
            'a_propos' => 'nullable|string'
        ]);

        $shop = Shop::create($request->all());

        return response()->json($shop, 201);
    }

    /**
     * Affiche les détails d'une boutique spécifique.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        return response()->json($shop);
    }

    /**
     * Met à jour les informations d'une boutique spécifique.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id', // Assurez-vous que l'utilisateur existe
            'logo' => 'nullable|string|max:255',
            'banniere' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'adresse' => 'nullable|string|max:255',
            'a_propos' => 'nullable|string'
        ]);

        $shop->update($request->all());

        return response()->json($shop, 200);
    }

    /**
     * Supprime une boutique spécifique.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();

        return response()->json(null, 204);
    }
}
