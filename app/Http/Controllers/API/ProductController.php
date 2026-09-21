<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('kategori')->latest()->paginate(10);
        
        return new ProductCollection($products);
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name'        => 'required|string',
        'price'       => 'required|numeric',
        'description' => 'required|string',
        'stock'       => 'required|integer',
        'Kategori'    => 'required|integer', // Kolom foreign key
    ]);

    $product = Product::create($validatedData);

    return response()->json([
        'message' => 'Product berhasil ditambahkan!',
        'data'    => $product
    ], 201);
}

    public function show(Product $product)
    {
        return response()->json([
            'status'  => true,
            'message' => 'Product retrieved successfully',
            'data'    => new ProductResource($product)
        ], Response::HTTP_OK);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return response()->json([
            'status'  => true,
            'message' => 'Product updated successfully',
            'data'    => new ProductResource($product),
        ], Response::HTTP_OK);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Product deleted successfully',
        ], Response::HTTP_OK);
    }
}