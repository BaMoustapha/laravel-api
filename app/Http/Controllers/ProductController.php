<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Affiche la liste des produits.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    /**
     * Enregistre un nouveau produit.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'image' => 'required|string',
            'description' => 'required|string',
            'prix' => 'required|numeric',
            'quantite' => 'required|integer',
            // 'categorie_id' => 'required|exists:categories,id',
        ]);

        $imagePath = Storage::disk('public')->put('images/posts/product-images', $request->file('product_image'));


        $product = Product::create([
            'nom' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $imagePath,
            'prix' => $request->input('prix'),
            'quantite' => $request->input('quantite'),
        ]);

        return response()->json($product, 201);
    }

    /**
     * Affiche les détails d'un produit.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Met à jour les informations d'un produit.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nom' => 'required|string',
            'image' => 'required|string',
            'description' => 'required|string',
            'prix' => 'required|numeric',
            'quantite' => 'required|integer',
            // 'categorie_id' => 'required|exists:categories,id',
        ]);

        $product->update($request->all());

        return response()->json($product, 200);
    }

    /**
     * Supprime un produit spécifique.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(null, 204);
    }
}
