<?php

use App\Http\Controllers\Admin\AdminDashboardController;
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
        Route::get('/products', [AdminDashboardController::class, 'home'])->name('admin.dashboard.products');
        Route::get('/products/create', [AdminDashboardController::class, 'createProduct'])->name('admin.dashboard.products.create');
    });

});

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
   Route::post('list',[ProductController::class, 'list'])->name('products.list');
   Route::post('create',[ProductController::class, 'store'])->name('products.create');
   Route::post('addphoto',[ProductController::class, 'addphoto'])->name('products.addphoto');
});

require __DIR__.'/auth.php';
