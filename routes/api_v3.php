<?php

use App\Http\Controllers\Api\V3\CategoryController;
use App\Http\Controllers\Api\V3\ProductController;
use App\Http\Controllers\Api\V3\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('categories', CategoryController::class);

    Route::get('products', [ProductController::class,  'index'])
        ->middleware('throttle:products');
});

Route::get('lists/categories', [CategoryController::class,  'list']);

Route::get('products/category/{category}', [ProductController::class, 'showByCategory']);

// muestr los comentarios de un producto
Route::get('products/{productId}/comments', [CommentController::class, 'index']);

// crea un comentario para un producto
Route::post('products/{productId}/comments', [CommentController::class, 'store']);

//incluir subida de imagenes
Route::post('products', [ProductController::class, 'store']);
