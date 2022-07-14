<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('product');

Route::get('/admin/products', [AdminController::class, 'index'])->name('admin.home');

Route::get('/admin/product/{product}/edit', [AdminController::class, 'edit'])->name('admin.edit');
Route::put('/admin/product/{product}', [AdminController::class, 'update'])->name('admin.update');

Route::get('/admin/product/create', [AdminController::class, 'create'])->name('admin.create');
Route::post('/admin/product', [AdminController::class, 'store'])->name('admin.store');

Route::get('/admin/product/{product}/delete', [AdminController::class, 'destroy'])->name('admin.destroy');
Route::get('/admin/product/{product}/delete-image', [AdminController::class, 'destroyImage'])->name('admin.destroyImage');
