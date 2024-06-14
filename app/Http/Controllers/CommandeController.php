<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Commande;

class CommandeController extends Controller
{
    /**
     * Affiche la liste des commandes.
     *
     * @return \Illuminate\Http\Response
     */

     public function index() 
     {
        $commandes = Commande::all();
        return response()->json($commandes, 200);
     }

     /**
     * Enregistre une nouvelle commande.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 /*   public function store(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'prenom' => 'required|string',
        'name' => 'required|string',
        'telephone' => 'required|numeric',
        'adresse' => 'required|string',
        'quantite' => 'required|integer',
         //'image' => 'required|image',
        'statut' => 'required|string',
        'ville' => 'required|string',
        'prixProduit' => 'required|numeric',
        'prixTotal' => 'required|numeric',
        'product_id.*' => 'required|exists:products,id',
        'prixLivraison' => 'required|string',
        'produits' => 'required|json',
    ]);

    $commandePath = null;
        if ($request->hasFile('commande')) {
            $commandePath = Storage::disk('public')->put('images/posts/commande-images', $request->file('commande'));
            $commandePath = asset('storage/' . $commandePath);
        }

    $commande = Commande::create([
        'prenom' => $request->input('prenom'),
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'telephone' => $request->input('telephone'),
        'adresse' => $request->input('adresse'),
        'quantite' => $request->input('quantite'),
        'statut' => $request->input('statut'),
         //'image' => $imagePath,
        'ville' => $request->input('ville'),
        'prixProduit' => $request->input('prixProduit'),
        'prixTotal' => $request->input('prixTotal'),
        'prixLivraison' => $request->input('prixLivraison'),
        'produits' => $request->input('produits'),
        'product_id' => $request->input('product_id')
    ]);

    return response()->json($commande, 201);
}
*/

public function store(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'prenom' => 'required|string',
        'name' => 'required|string',
        'telephone' => 'required|string',
        'adresse' => 'required|string',
        'ville' => 'required|string',
        'quantite' => 'required|integer',
        'statut' => 'required|string',
        'prixProduit' => 'required|numeric',
        'prixTotal' => 'required|numeric',
        'product_id' => 'required|exists:products,id',
        'prixLivraison' => 'required|numeric',
        'produits' => 'required|array',
    ]);

    $commande = Commande::create($request->all());
    return response()->json($commande, 201);
}


/**
     * Affiche les détails d'un produit.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show ($id)
    {
        $commande = Commande::findOrFail($id);
        return response()->json($commande, 201);

    }

    /**
     * Affiche les détails d'un produit.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */




     /**
     * Supprime une boutique spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function destroy($id)
     {
        $commande = Commande::findOrFail($id);
        $commande->delete();
         return response()->json(null, 204);
     }
}