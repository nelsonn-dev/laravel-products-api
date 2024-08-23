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
            ], $e->getCode());
        }
    }

    public function store(Request $request)
    {
        return $request;
    }

    public function show(int $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                throw new Exception("Product not found.", 404);
            }

            return response()->json([
                'message' => "Success.",
                'data' => $product,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => [],
            ], $e->getCode());
        }
    }

    public function update(Request $request, int $id)
    {
        //
    }

    public function destroy(int $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                throw new Exception("Product not found.", 404);
            }

            $product->delete();

            return response()->json([
                'message' => "Success.",
                'data' => [],
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => [],
            ], $e->getCode());
        }
    }
}
