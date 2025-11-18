<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Menampilkan semua produk
     */
    public function index()
    {
        $products = Product::with('category')->get();

        return response()->json([
            'status' => 'success',
            'data' => $products
        ], 200);
    }

    /**
     * Menambah produk baru
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $product = Product::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Product created successfully',
            'data' => $product->load('category')
        ], 201);
    }

    /**
     * Soal 3: Update stok produk berdasarkan ID
     * Method: PATCH/PUT
     * Endpoint: /api/products/{id}/stock
     */
    public function updateStock(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'stock' => 'required|integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found',
                'data' => null
            ], 404);
        }

        $oldStock = $product->stock;
        $product->stock = $request->stock;
        $product->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Stock updated successfully',
            'data' => [
                'id' => $product->id,
                'name' => $product->name,
                'old_stock' => $oldStock,
                'new_stock' => $product->stock,
                'updated_at' => $product->updated_at
            ]
        ], 200);
    }

    /**
     * Soal 4: Menghapus seluruh produk yang stoknya habis
     * Method: DELETE
     * Endpoint: /api/products/out-of-stock
     */
    public function deleteOutOfStock()
    {
        $products = Product::where('stock', 0)->get();
        
        if ($products->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'No out of stock products found',
                'data' => [
                    'deleted_count' => 0
                ]
            ], 200);
        }

        $deletedCount = Product::where('stock', 0)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Out of stock products deleted successfully',
            'data' => [
                'deleted_count' => $deletedCount,
                'deleted_products' => $products->pluck('name')
            ]
        ], 200);
    }

    /**
     * Soal 5: Pencarian produk berdasarkan nama
     * Method: GET
     * Endpoint: /api/products/search?name=keyword
     */
    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $keyword = $request->query('name');
        
        $products = Product::with('category')
            ->where('name', 'LIKE', "%{$keyword}%")
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Products retrieved successfully',
            'data' => [
                'keyword' => $keyword,
                'count' => $products->count(),
                'products' => $products
            ]
        ], 200);
    }
}