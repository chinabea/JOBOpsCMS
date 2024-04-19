<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::post('/users', [UserController::class, 'store']);


Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', function () {
        return view('admin');
    })->name('admin');

});

Route::middleware(['auth', 'staff'])->group(function () {

    Route::get('/staff', function () {
        return view('staff');
    })->name('staff');
});

