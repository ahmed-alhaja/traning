<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});
// warum ???
Route::get('products{id}/images', [ProductImageController::class, 'index'])->name('products.images');
Route::delete('products/images/{img}', [ProductImageController::class, 'destroy'])->name('products.images.destroy');
Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);

Route::get('/dashboard', function () {
    return view('/starter');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    // Route::get('logout' , function(){
    //     Auth::logout();
    //     return redirect('/login');
    // }); 
});

require __DIR__ . '/auth.php';
