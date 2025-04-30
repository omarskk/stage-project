<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ModeleController;
use App\Http\Controllers\BrandController;
use \App\Http\Controllers\CategoryController;
Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::resource('products', ProductController::class);

Route::get('brands', [BrandController::class, 'index'])->name('brand.index');
Route::get('brands/create', [BrandController::class, 'create'])->name('brand.create');
Route::post('brands', [BrandController::class, 'store'])->name('brand.store');
Route::get('brands/{brand}/edit', [BrandController::class, 'edit'])->name('brand.edit');
Route::put('brands/{brand}', [BrandController::class, 'update'])->name('brand.update');
Route::delete('brands/{brand}', [BrandController::class, 'destroy'])->name('brand.destroy');
Route::resource('modele', ModeleController::class);

Route::resource('category',CategoryController::class);
Route::get('/get-modeles/{brand_id}', [App\Http\Controllers\ModeleController::class, 'getByBrand']);
