<?php

use App\Http\Controllers\Admin\AdminDashboardController;
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
    Route::get('/dashboard', [AdminDashboardController::class, 'home'])->name('admin.dashboard.home');
    Route::get('/products', [AdminDashboardController::class, 'home'])->name('admin.dashboard.products');

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

require __DIR__.'/auth.php';
