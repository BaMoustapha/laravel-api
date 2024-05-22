<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
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

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'nom' => 'required|unique:categories,nom,' . $category->id,
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
