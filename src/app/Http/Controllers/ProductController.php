<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list(Request $request)
    {
        try {
            $products = Product::orderBy('id', 'desc')->paginate($request->per_page ?: 10);

            return response()->json([
                'message' => "Success.",
                'data' => $products,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => [],
            ], 400);
        }
    }

    public function store(Request $request)
    {
        return $request;
    }

    public function show(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}
