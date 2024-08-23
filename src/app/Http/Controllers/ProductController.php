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
            $products = Product::orderBy('id', 'desc')
                ->with('Category')
                ->paginate($request->per_page ?: 10);

            return response()->json([
                'message' => "Success.",
                'data' => $products,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => [],
            ], $e->getCode() ?: 400);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|max:50',
                'description' => 'required|max:200',
                'price' => 'required|numeric',
                'expiration_date' => 'required|string',
                'image_url' => 'required|string',
                'category_id' => 'required|integer'
            ]);

            $product = Product::create([
                "name" => $request->name,
                "description" => $request->description,
                "price" => $request->price,
                "expiration_date" => $request->expiration_date,
                "image_url" => $request->image_url,
                "category_id" => $request->category_id
            ]);

            $product->category;

            return response()->json([
                'message' => "Success.",
                'data' => $product,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => [],
            ], 400);
        }
    }

    public function show(int $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                throw new Exception("Product not found.", 404);
            }

            $product->category;

            return response()->json([
                'message' => "Success.",
                'data' => $product,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => [],
            ], $e->getCode() ?: 400);
        }
    }

    public function update(Request $request, int $id)
    {
        try {
            $request->validate([
                'name' => 'max:50',
                'description' => 'max:200',
                'price' => 'numeric',
                'expiration_date' => 'string',
                'image_url' => 'string',
                'category_id' => 'numeric'
            ]);

            $product = Product::find($id);

            if (!$product) {
                throw new Exception("Product not found.", 404);
            }

            if ($request->name) $product->name = $request->name;
            if ($request->description) $product->description = $request->description;
            if ($request->price) $product->price = $request->price;
            if ($request->expiration_date) $product->expiration_date = $request->expiration_date;
            if ($request->image_url) $product->image_url = $request->image_url;
            if ($request->category_id) $product->category_id = $request->category_id;

            $product->save();

            $product->category;

            return response()->json([
                'message' => "Success.",
                'data' => $product,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => [],
            ], 400);
        }
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
            ], $e->getCode() ?: 400);
        }
    }

    public function search(Request $request)
    {
        try {
            $request->validate([
                'key' => 'required|string|max:200',
            ]);

            $products = Product::where('name', 'like', "%" . $request->key . "%")
                ->with('Category')
                ->orWhere('description', 'like', "%" . $request->key . "%")
                ->orderBy('id', 'desc')
                ->paginate($request->per_page ?: 10);

            return response()->json([
                'message' => "Success.",
                'data' => $products,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => [],
            ], $e->getCode() ?: 400);
        }
    }

    public function getByCategory(Request $request, int $category_id)
    {
        try {
            $products = Product::where('category_id', $category_id)
                ->with('Category')
                ->orderBy('id', 'desc')
                ->paginate($request->per_page ?: 10);

            return response()->json([
                'message' => "Success.",
                'data' => $products,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => [],
            ], $e->getCode() ?: 400);
        }
    }
}
