<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UnitController;
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

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticate']);
});

Route::middleware('auth')->group(function () {
    Route::view('/', 'dashboard')->name('dashboard');

    // ** Product Modules
    Route::resource('products', ProductController::class)->middleware('optimizeImages');
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('units', UnitController::class)->except(['show']);

    // ** Ajax Request
    Route::middleware('ajax')->group(function () {
        Route::get('categories/select2', [CategoryController::class, 'select2'])->name('categories.select2');
        Route::get('units/select2', [UnitController::class, 'select2'])->name('units.select2');
    });

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
