<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FranchiseController;

// Public Routes
Route::get('/', function () {
    return view('index');
})->name('home');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Logout Route (Only for Authenticated Users)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Authenticated Routes
Route::middleware('auth')->group(function () {

    // Dashboard Route
    Route::get('/dashboard', function () {
        return view('dashboard'); // Ensure 'dashboard.blade.php' exists
    })->name('dashboard');

    // Franchise Management Routes
    Route::prefix('franchise')->group(function () {
        Route::get('/manage', [FranchiseController::class, 'index'])->name('franchise.manage');
        Route::get('/add', [FranchiseController::class, 'create'])->name('franchise.add'); // Uses Controller instead of Closure
        Route::post('/store', [FranchiseController::class, 'store'])->name('franchise.store');
        Route::get('/edit/{id}', [FranchiseController::class, 'edit'])->name('franchise.edit');
        Route::put('/update/{id}', [FranchiseController::class, 'update'])->name('franchise.update');
        Route::delete('/delete/{id}', [FranchiseController::class, 'destroy'])->name('franchise.delete');
        Route::get('/view/{id}', [FranchiseController::class, 'show'])->name('franchise.view');
    });

    // User Management Routes (Admin Only)
    Route::prefix('users')->middleware('admin')->group(function () { // Ensures only admins can access
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::post('/{id}/status', [UserController::class, 'updateStatus'])->name('users.status');
    });
});
