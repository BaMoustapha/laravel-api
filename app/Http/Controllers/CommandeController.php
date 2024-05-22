<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'prenom' => 'required|string',
            'name' => 'required|string',
            'telephone' => 'required|numeric',
            'adresse' => 'required|string',
            'quantite' => 'required|integer',
            'image' => 'required|image',
            'statut' => 'required|string',
            'ville' => 'required|string',
            'prixProduit' => 'required|numeric',
            'prixTotal' => 'required|numeric',
            'product_id' => 'required|exists:products,id',
            'prixLivraison' => 'required|string',
            'produits' => 'required|string',

        ]);
         // Gestion de l'enregistrement de l'image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = Storage::disk('public')->put('images/posts/image-images', $request->file('image'));
        }

        $commande = Commande::create([
            'prenom' => $request->input('prenom'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'telephone' => $request->input('telephone'),
            'adresse' => $request->input('adresse'),
            'quantite' => $request->input('quantite'),
            'statut' => $request->input('statut'),
            'image' => $imagePath,
            'ville' => $request->input('ville'),
            'prixProduit' => $request->input('prix'),
            'prixTotal' => $request->input('prixTotal'),
            'prixLivraison' => $request->input('prixLivraison'),
            'produits' => $request->input('produits'),
            'product_id' => $request->input('product_id')
        ]);
         return response()->json($commande, 201);
    }
}
