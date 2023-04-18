<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    public function index()
    {
        $product = Product::all();

        return ProductResource::collection($product);
    }

    public function store(Request $request)
    {
        $product = Product::create($request->all());

        return new ProductResource($product);
    }


    public function show(Product $product)
    {
        return new ProductResource($product);
    }


    public function update(Request $request, Product $product)
    {
        $product->update($request->all());

        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response(null, 204);
    }
}