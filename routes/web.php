<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\UserPaymentStatus;
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

Route::get('/', [AppController::class, 'home'])->name('site.home');

Route::middleware(['auth','verified'])->prefix('dashboard')->group(function(){
    Route::get('/', function(){ return View('dashboard');})->name('dashboard');
});

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

    Route::delete('/profile/orders', [UserPaymentStatus::class,'destroy'])->name('profile.orders');
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

// Category Routes
Route::get('categories/{slug}',[CategoryController::class, 'show'])->name('categories.show');
Route::middleware(['auth','verified'])->prefix('categories')->group(function() {
    Route::get('create',[CategoryController::class, 'create'])->name('categories.create');
    Route::post('create',[CategoryController::class, 'store'])->name('categories.store');
    Route::delete('delete/{id}',[CategoryController::class, 'destroy'])->name('categories.delete');
    Route::put('update',[CategoryController::class, 'destroy'])->name('categories.update');

    Route::post('addproduct', [CategoryController::class, 'addProduct'])->name('categories.addproduct');
    Route::post('removeproduct', [CategoryController::class, 'removeProduct'])->name('categories.removeproduct');
});

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

// Product Routes
Route::middleware(['auth','verified'])->prefix('products')->group(function() {

    Route::post('create',[ProductController::class, 'store'])->name('products.create');
    Route::delete('delete/{id}',[ProductController::class, 'destroy'])->name('products.delete');
    Route::put('update',[ProductController::class, 'destroy'])->name('products.update');
    Route::post('addphoto',[ProductController::class, 'addphoto'])->name('products.addphoto');

    Route::post('add-to-cart',[ProductController::class, 'addToCart'])->name('products.addToCart');
    Route::post('remove-from-cart',[ProductController::class, 'removeFromCart'])->name('products.removeFromCart');
});


// Cart Routes
Route::middleware(['auth','verified'])->prefix('cart')->group(function() {

    Route::get('mycart',[CartController::class, 'index'])->name('cart.show');

    Route::post('/', [CartController::class, 'store'])->name('cart.create');
    Route::patch('/', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/', [CartController::class, 'destroy'])->name('cart.delete');

});

// Checkout Routes
Route::middleware(['auth','verified'])->prefix('checkout')->group(function(){
    Route::get('payment',[CheckoutController::class, 'create']);

});
Route::post('checkout/payment/webhook',[CheckoutController::class, 'paymentStatusWebhook'])->name('checkout.paymentStatusResponse');
Route::post('checkout/payment/webhook',[CheckoutController::class, 'paymentStatusWebhook'])->name('checkout.paymentStatusResponse');


Route::get('/products/{slug}',[ProductController::class, 'show'])->name('products.show');

require __DIR__.'/auth.php';
