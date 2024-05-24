<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class CategoryController extends Controller
{
    public function index(Request $request)
    {

            $categories = Category::all();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories',
            'shop_id' => 'nullable|exists:shops,id'
        ]);

        $category = Category::create([
            'name' => $request->input('name'),
            'shop_id' => $request->input('shop_id')
        ]);

        return response()->json($category, 201);
    }



//     class ShopController extends Controller
// {
//     // premiere Partie
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

// deuxiem Partie
    // public function getShopWithCategories($shopId)
    // {
    //     $user = Auth::user();
    //     $shop = Shop::where('user_id', $user->id)->with('categories')->findOrFail($shopId);

    //     return response()->json($shop);
    // }


    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
            'shop_id' => 'nullable|exists:shops,id',
        ]);

        $category->update($request->all());

        return response()->json(['message' => 'Category updated successfully.']);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully.']);
    }
}
