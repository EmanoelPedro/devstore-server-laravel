<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('site.home');

Route::get('/dashboard', function(){ return View('dashboard');})->name('dashboard');


Route::middleware(['auth', 'verified'])->prefix('admin')->group(function(){

    Route::get('/', function(){ return redirect()->route('admin.dashboard.home');});

    Route::middleware(['auth','verified'])->prefix('dashboard')->group(function(){

        Route::get('/', [AdminDashboardController::class, 'home'])->name('admin.dashboard.home');

        Route::get('/products', [AdminDashboardController::class, 'home'])
            ->name('admin.dashboard.products');

        Route::get('/products/create', [AdminDashboardController::class, 'createProduct'])
            ->name('admin.dashboard.products.create');

        Route::get('/products/edit/{id}', [AdminDashboardController::class, 'editProduct'])
            ->name('admin.dashboard.products.edit');
    });

});

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Verification Email Routes
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('site.home');
})->middleware(['auth', 'signed'])->name('verification.verify');


// Product Routes
Route::middleware(['auth','verified'])->prefix('products')->group(function() {

    Route::post('create',[ProductController::class, 'store'])->name('products.create');
   Route::delete('delete/{id}',[ProductController::class, 'destroy'])->name('products.delete');
   Route::put('update',[ProductController::class, 'destroy'])->name('products.update');
   Route::post('addphoto',[ProductController::class, 'addphoto'])->name('products.addphoto');

   Route::post('addtocard',[ProductController::class, 'addToCard'])->name('products.addToCard');
Route::post('removetocard',[ProductController::class, 'removeToCard'])->name('products.addToCard');

});


// Cart Routes
Route::middleware(['auth','verified'])->prefix('cart')->group(function() {
    Route::post('create', [CartController::class, 'store'])->name('cart.create');
    Route::post('addproduct', [CartController::class, 'addProduct'])->name('cart.addProduct');
    Route::post('delete', [CartController::class, 'destroy'])->name('cart.delete');

    Route::get('mycart', [CartController::class, 'show'])->name('cart.mycart');
});

// Checkout Routes
Route::middleware(['auth','verified'])->prefix('checkout')->group(function(){
    Route::get('payment',[CheckoutController::class, 'create']);
});


Route::get('/products/{id}',[ProductController::class, 'index'])->name('products.list');

require __DIR__.'/auth.php';
