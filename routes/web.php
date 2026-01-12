<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\PendirianCVController;
use App\Http\Controllers\PendirianPTController;
use App\Http\Controllers\KbliController;
use App\Http\Controllers\DependantDropdownController;

// Redirect root ke user login
// Redirect root (/) ke halaman login user
Route::get('/', function () {
    return redirect()->route('user.login');
});


// Routes untuk User (dengan prefix 'user')
Route::prefix('user')->name('user.')->group(function () {

    // Guest routes (belum login)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');

        Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    });

    // Authenticated routes (sudah login)
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});

Route::prefix('pendirian')->group(function () {
    Route::get('/cv', [PendirianCVController::class, 'index'])->name('pendirian.cv.index');
    Route::get('/cv/form', [PendirianCVController::class, 'create'])->name('pendirian.cv.form');
    Route::post('/cv/form', [PendirianCVController::class, 'store'])->name('pendirian.cv.store');
    Route::get('/cv/processing', [PendirianCVController::class, 'processing'])->name('pendirian.cv.processing');
    Route::get('/cv/{id}/edit', [PendirianCVController::class, 'edit'])->name('pendirian.cv.edit');
    Route::put('/cv/{id}', [PendirianCVController::class, 'update'])->name('pendirian.cv.update');
    Route::get('/cv/{id}', [PendirianCVController::class, 'show'])->name('pendirian.cv.show');
    Route::delete('/cv/{id}', [PendirianCVController::class, 'destroy'])->name('pendirian.cv.destroy');

    Route::get('/pt', [PendirianPTController::class, 'index'])->name('pendirian.pt.index');
    Route::get('/pt/form', [PendirianPTController::class, 'create'])->name('pendirian.pt.form');
    Route::post('/pt/form', [PendirianPTController::class, 'store'])->name('pendirian.pt.store');
});
Route::get('/kbli/search', [KbliController::class, 'search'])->name('kbli.search');
Route::get('/api/kbli/search', [KbliController::class, 'search'])->name('kbli.search.api');

Route::get('/provinces', [DependantDropdownController::class, 'provinces'])->name('provinces');
Route::get('/cities', [DependantDropdownController::class, 'cities'])->name('cities');
Route::get('/districts', [DependantDropdownController::class, 'districts'])->name('districts');
Route::get('/villages', [DependantDropdownController::class, 'villages'])->name('villages');
