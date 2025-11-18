<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TransactionController;

// Categories
Route::post('/categories', [CategoryController::class, 'store']);
Route::get('/categories', [CategoryController::class, 'index']);

// Products - PERHATIKAN URUTAN!
Route::get('/products/search', [ProductController::class, 'search']); // Harus di atas
Route::delete('/products/out-of-stock', [ProductController::class, 'deleteOutOfStock']); // Harus di atas
Route::patch('/products/{id}/stock', [ProductController::class, 'updateStock']); // Setelah route spesifik
Route::put('/products/{id}/stock', [ProductController::class, 'updateStock']); // Alternative method
Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);

// Transactions
Route::get('/transactions', [TransactionController::class, 'index']);
Route::post('/transactions', [TransactionController::class, 'store']);