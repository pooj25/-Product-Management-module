<?php
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PurchaseController;
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('purchases', PurchaseController::class)
    ->only(['index', 'create', 'store', 'show']);