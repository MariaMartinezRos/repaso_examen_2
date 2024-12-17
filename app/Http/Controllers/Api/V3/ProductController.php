<?php

namespace App\Http\Controllers\Api\V3;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(9);

        return ProductResource::collection($products);
    }
    public function showByCategory($categoryId)
    {
        //esto se podria usar, pero a mi no me funciona ninguna
//        $category = Category::findOrFail($categoryId);

        //con la de arriba no hace falta el if, pero con las de abajo si
//        $category = Category::find($categoryId);

//        $category = Category::where('id', $categoryId)->first();

        $category = Category::query()->whereRaw('id = ?', [$categoryId])->first();

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        $products = $category->products;

        return response()->json([
            'category' => $category->name,
            'products' => $products
        ]);
    }
}
