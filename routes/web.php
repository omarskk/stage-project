<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\ModeleController;
use App\Http\Controllers\BrandController;
use \App\Http\Controllers\CategoryController;
Route::get('/', function () {
    return view('welcome');
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

Route::resource('operations', OperationController::class);



Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
use App\Http\Controllers\UserController;

Route::get('/users', [UserController::class, 'index'])->name('users.index');


Route::get('/operations', [OperationController::class, 'index'])->name('operations.index');

Route::resource('users', UserController::class);  // This will automatically generate the necessary routes for index, create, store, edit, update, and destroy.

require __DIR__.'/auth.php';
