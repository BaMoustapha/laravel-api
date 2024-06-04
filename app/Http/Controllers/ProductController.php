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
            'name' => 'required|string',
            'image' => 'required|image',
            'description' => 'required|string',
            'prix' => 'required|numeric',
            'quantite' => 'required|integer',
            'categorie_id' => 'required|exists:categories,id'
        ]);

        // Gestion de l'enregistrement de l'image
        $imagePath = Storage::disk('public')->put('images/posts/product-images', $request->file('image'));

        $product = Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $imagePath,
            'prix' => $request->input('prix'),
            'quantite' => $request->input('quantite'),
            'categorie_id' => $request->input('categorie_id')
        ]);

        return response()->json($product, 201);
    }

    /**
     * Affiche les détails d'un produit.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Met à jour les informations d'un produit.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

       $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'prix' => 'required|numeric',
            'quantite' => 'required|integer',
            'categorie_id' => 'required|integer|exists:categories,id',
            'image' => 'nullable|image', // Optional image validation
        ]);

        // $data = [
        //     'name' => $request->input('name'),
        //     'description' => $request->input('description'),
        //     'prix' => $request->input('prix'),
        //     'quantite' => $request->input('quantite'),
        //     'categorie_id' => $request->input('categorie_id'),
        // ];

        // Manage image update if a new image is provided
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image); // Delete old image
            }
            $imagePath = Storage::disk('public')->put('images/posts/product-images', $request->file('image'));
            $data['image'] = $imagePath;
        }

        $product->update($data);
        $product->refresh();

        return response()->json($product, 200);
    }





    /**
     * Supprime un produit spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(null, 204);
    }
}
