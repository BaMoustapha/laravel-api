<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

use Illuminate\Support\Facades\Validator; // For validation

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::all();
        return response()->json($shops, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // This method is not applicable when not using Blade views
        // You can remove it or use it for other purposes within the controller
        return response()->json(['message' => 'Use POST /shops to create a shop'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400); // Bad request with validation errors
        }

        $shop = Shop::create($request->all());
        return response()->json($shop, 201); // Created
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shop = Shop::find($id);

        if (!$shop) {
            return response()->json(['error' => 'Shop not found'], 404);
        }

        return response()->json($shop, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Similar to create(), this might not be applicable without Blade views
        return response()->json(['message' => 'Use PUT /shops/{id} to update a shop'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400); // Bad request with validation errors
        }

        $shop = Shop::find($id);

        if (!$shop) {
            return response()->json(['error' => 'Shop not found'], 404);
        }

        $shop->update($request->all());
        return response()->json($shop, 200); // Updated
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shop = Shop::find($id);

        if (!$shop) {
            return response()->json(['error' => 'Shop not found'], 404);
        }

        $shop->delete();
        return response()->json(['message' => 'Shop deleted successfully'], 204); // No content
    }
}