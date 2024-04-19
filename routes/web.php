<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::get('/admin', function () {
    return view('admin');
})->name('admin');

Route::get('/staff', function () {
    return view('staff');
})->name('staff');

Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/edit-user/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/delete-user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
