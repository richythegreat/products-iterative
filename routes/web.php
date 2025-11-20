<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
Route::redirect('/', '/products');
// Produkta daudzuma maiņas maršruti
Route::post('/products/{product}/increase', [ProductController::class, 'increaseQuantity'])->name('products.increase');
Route::post('/products/{product}/decrease', [ProductController::class, 'decreaseQuantity'])->name('products.decrease');
// Autocomplete
Route::get('/tags/search', [ProductController::class, 'searchTags'])
    ->name('tags.search');

// Update tags with PUT
Route::put('/products/{product}/update-tags', [ProductController::class, 'updateTags'])
    ->name('products.updateTags');


Route::resource('products', ProductController::class);