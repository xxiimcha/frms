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

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); // Ensure 'dashboard.blade.php' exists
    })->name('dashboard');

    // Franchise Management Routes
    Route::prefix('franchise')->group(function () {
        Route::get('/manage', function () {
            return view('franchise.manage');
        })->name('franchise.manage');

        Route::get('/add', function () {
            return view('franchise.add');
        })->name('franchise.add');

        Route::post('/store', [FranchiseController::class, 'store'])->name('franchise.store');
    });

    // User Management Routes (Admin Only)
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::post('/{id}/status', [UserController::class, 'updateStatus'])->name('users.status');
    });
});
