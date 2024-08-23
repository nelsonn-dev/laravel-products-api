<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list(Request $request)
    {
        try {
            $categories = Category::orderBy('id', 'desc')->paginate($request->per_page ?: 10);

            return response()->json([
                'message' => "Success.",
                'data' => $categories,
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
                'name' => 'required|max:100',
            ]);

            $category = Category::create([
                "name" => $request->name,
            ]);

            return response()->json([
                'message' => "Success.",
                'data' => $category,
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
            $category = Category::find($id);

            if (!$category) {
                throw new Exception("Category not found.", 404);
            }

            return response()->json([
                'message' => "Success.",
                'data' => $category,
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
                'name' => 'max:100',
            ]);

            $category = Category::find($id);

            if (!$category) {
                throw new Exception("Category not found.", 404);
            }

            if ($request->name) $category->name = $request->name;

            $category->save();

            return response()->json([
                'message' => "Success.",
                'data' => $category,
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
            $category = Category::find($id);

            if (!$category) {
                throw new Exception("Category not found.", 404);
            }

            $category->delete();

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
}
