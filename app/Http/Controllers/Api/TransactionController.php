<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Soal 2: Menampilkan daftar transaksi pembelian produk
     * Method: GET
     * Endpoint: /api/transactions
     */
    public function index()
    {
        $transactions = Transaction::with('product.category')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Transactions retrieved successfully',
            'data' => $transactions->map(function ($transaction) {
                return [
                    'id' => $transaction->id,
                    'product' => [
                        'id' => $transaction->product->id,
                        'name' => $transaction->product->name,
                        'price' => $transaction->product->price,
                        'category' => $transaction->product->category->name
                    ],
                    'quantity' => $transaction->quantity,
                    'total_price' => $transaction->total_price,
                    'customer_name' => $transaction->customer_name,
                    'transaction_date' => $transaction->transaction_date->format('Y-m-d H:i:s'),
                    'created_at' => $transaction->created_at
                ];
            })
        ], 200);
    }

    /**
     * Membuat transaksi baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'customer_name' => 'required|string|max:255'
        ]);

        $product = \App\Models\Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return response()->json([
                'status' => 'error',
                'message' => 'Insufficient stock'
            ], 400);
        }

        $totalPrice = $product->price * $request->quantity;

        $transaction = Transaction::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'customer_name' => $request->customer_name,
            'transaction_date' => now()
        ]);

        // Update stock
        $product->decrement('stock', $request->quantity);

        return response()->json([
            'status' => 'success',
            'message' => 'Transaction created successfully',
            'data' => $transaction
        ], 201);
    }
}