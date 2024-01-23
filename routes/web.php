<?php

use App\Http\Controllers\UserAddressController;
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


Route::middleware(['auth', 'verified'])->prefix('admin')->group(function()
    {

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
Route::middleware('auth')->group(function ()
{
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profile/address', [UserAddressController::class,'index'])->name('profile.address');
    Route::post('/profile/address', [UserAddressController::class,'store'])->name('profile.address');
    Route::patch('/profile/address', [UserAddressController::class,'update'])->name('profile.address');
    Route::delete('/profile/address', [UserAddressController::class,'destroy'])->name('profile.address');
});

// Verification Email Routes
Route::get('/email/verify', function ()
{
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

    Route::post('addtocart',[ProductController::class, 'addToCart'])->name('products.addToCart');
    Route::post('removetocart',[ProductController::class, 'removeToCart'])->name('products.removeToCart');
});


// Cart Routes
Route::middleware(['auth','verified'])->prefix('cart')->group(function() {

    Route::get('mycart',[CartController::class, 'index'])->name('cart.index');

    Route::post('/', [CartController::class, 'store'])->name('cart.create');
    Route::patch('/', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/', [CartController::class, 'destroy'])->name('cart.delete');

});

// Checkout Routes
Route::middleware(['auth','verified'])->prefix('checkout')->group(function(){
    Route::get('payment',[CheckoutController::class, 'create']);
});

Route::get('/products/{id}',[ProductController::class, 'index'])->name('products.list');

require __DIR__.'/auth.php';
