<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Soal 1: Menambahkan kategori produk baru
     * Method: POST
     * Endpoint: /api/categories
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $category = Category::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Category created successfully',
            'data' => [
                'id' => $category->id,
                'name' => $category->name,
                'description' => $category->description,
                'created_at' => $category->created_at
            ]
        ], 201);
    }

    /**
     * Menampilkan semua kategori
     */
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'status' => 'success',
            'data' => $categories
        ], 200);
    }
}