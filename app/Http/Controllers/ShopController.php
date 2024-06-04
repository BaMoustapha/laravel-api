<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Models\Category;

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


        // $user = $request->user();
         // Obtenez l'utilisateur authentifié
         $user = $request->user();
        
         // Vérifiez si l'utilisateur est authentifié
         if (!$user) {
             return response()->json(['message' => 'Utilisateur non authentifié.'], 401);
         }
 
         // Vérifier si l'utilisateur a déjà une boutique
         if ($user->shop) {
             return response()->json(['message' => 'Vous avez déjà une boutique.'], 403);
         }

        $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Logo : JPEG, PNG, max 2 Mo
            'banniere' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'telephone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'adresse' => 'nullable|string|max:255',
            'a_propos' => 'nullable|string',
            'user_id' => 'nullable|integer|exists:users,id'
        ]);

           
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = Storage::disk('public')->put('images/posts/logo-images', $request->file('logo'));
            $logoPath = asset('storage/' . $logoPath);
        }

        $bannierePath = null;
        if ($request->hasFile('banniere')) {
            $bannierePath = Storage::disk('public')->put('images/posts/banniere-images', $request->file('banniere'));
            $bannierePath = asset('storage/' . $bannierePath);
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

        // Retourner la réponse JSON avec les URL des images
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
     
         $validated = $request->validate([
             'name' => 'required|string|max:255',
             'description' => 'nullable|string',
             'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
             'banniere' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
             'telephone' => 'nullable|string|max:255',
             'email' => 'nullable|email|max:255',
             'adresse' => 'nullable|string|max:255',
             'a_propos' => 'nullable|string'
         ]);
     
         if ($request->hasFile('logo')) {
             $logoPath = Storage::disk('public')->put('images/posts/logo-images', $request->file('logo'));
             $logoPath = asset('storage/' . $logoPath);
             $validated['logo'] = $logoPath;
         }
     
         if ($request->hasFile('banniere')) {
             $bannierePath = Storage::disk('public')->put('images/posts/banniere-images', $request->file('banniere'));
             $bannierePath = asset('storage/' . $bannierePath);
             $validated['banniere'] = $bannierePath;
         }
     
         $shop->update($validated);
     
         // Fetch the updated shop data from the database (important!)
         $shop->refresh();
     
         return response()->json($shop, 200);
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

     /**
     * Affiche la liste des boutiques associées à l'utilisateur connecté.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function userShops(Request $request)
    {   $userId = auth()->id();
        $user = $request->user(); // Récupérer l'utilisateur connecté
        $userShops = $user->shop; // Récupérer les boutiques associées à l'utilisateur
        return response()->json($userShops, 200);
    }
// Pour verifier l'utilisateur est authentifie
//     public function addCategoriesToShop(Request $request, $shopId)
// {
//     $user = Auth::user();
//     $shop = Shop::where('user_id', $user->id)->findOrFail($shopId);

//     $validated = $request->validate([
//         'categories' => 'required|array',
//         'categories.*' => 'required|string|max:255'
//     ]);

//     foreach ($validated['categories'] as $categoryName) {
//         $category = new Category(['name' => $categoryName]);
//         $shop->categories()->save($category);
//     }

//     return response()->json(['message' => 'Catégories ajoutées avec succès à la boutique'], 201);
// }

public function addCategoriesToShop(Request $request, $shopId)
{
    $shop = Shop::findOrFail($shopId);

    $validated = $request->validate([
        'categories' => 'required|array',
        'categories.*' => 'required|string|max:255'
    ]);

    foreach ($validated['categories'] as $categoryName) {
        $category = new Category(['name' => $categoryName]);
        $shop->categories()->save($category);
    }

    return response()->json(['message' => 'Catégories ajoutées avec succès à la boutique'], 201);
}

public function getShopCategories($shopId)
{
    $shop = Shop::findOrFail($shopId);

    $categories = $shop->categories;

    return response()->json($categories, 200);
}

}
