<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // List all products, with search/filter functionality
    public function index(Request $request)
    {
        $query = Product::query();

        // Optional filtering by category or product_name
        if ($request->has('category')) {
            $query->where('category', $request->input('category'));
        }

        if ($request->has('search')) {
            $query->where('product_name', 'like', '%' . $request->input('search') . '%');
        }

        return response()->json($query->get());
    }

    // Show a specific product
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    // Add a new product
    public function store(Request $request)
    {
        $request->validate([
            'barcode' => 'required|unique:products',
            'product_name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category' => 'required',
        ]);

        $product = Product::create($request->all());
        return response()->json($product, 201);

        //post
        // $product = new Product();
        // $product->barcode = $request->barcode;
        // $product->product_name = $request->product_name;
        // $product->description = $request->description;
        // $product->price = $request->price;
        // $product->quantity = $request->quantity;
        // $product->category = $request->category;
        // $product->save();
        // return response()->json($product, 201);
    }

    // Update an existing product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'barcode' => 'sometimes|required|unique:products,barcode,' . $id,
            'product_name' => 'sometimes|required',
            'description' => 'sometimes|required',
            'price' => 'sometimes|required|numeric',
            'quantity' => 'sometimes|required|integer',
            'category' => 'sometimes|required',
        ]);

        $product->update($request->all());
        return response()->json($product);
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(null, 204);
    }
}