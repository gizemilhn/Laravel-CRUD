<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/',[ProductController:: class,'index']);
Route::resource('product',ProductController::class);


Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/products/trashed', [ProductController::class, 'trashed'])->name('products.trashed');
Route::post('/products/restore/{id}', [ProductController::class, 'restore'])->name('products.restore');


