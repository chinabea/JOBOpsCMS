<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\NotificationController;
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

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
Route::get('/mark-notification-as-read/{notification}', [NotificationController::class, 'markAsRead'])->name('mark-notification-as-read');

Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/edit-user/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/delete-user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

Route::get('/tickets', [TicketController::class, 'index'])->name('tickets');
Route::get('/create/ticket', [TicketController::class, 'create'])->name('create.ticket');
Route::post('/store/ticket', [TicketController::class, 'store'])->name('store.ticket');
Route::get('/edit-ticket/{id}', [TicketController::class, 'edit'])->name('edit.ticket');
Route::put('/edit-ticket/{id}', [TicketController::class, 'update'])->name('update.ticket');
Route::delete('/delete-ticket/{id}', [TicketController::class, 'destroy'])->name('destroy.ticket');

Route::get('/faqs', [FaqsController::class, 'index'])->name('faqs');
Route::get('/create/faq', [FaqsController::class, 'create'])->name('create.faq');
Route::post('/store/faq', [FaqsController::class, 'store'])->name('store.faq');
Route::get('/edit-faq/{id}', [FaqsController::class, 'edit'])->name('edit.faq');
Route::put('/edit-faq/{id}', [FaqsController::class, 'update'])->name('update.faq');
Route::delete('/delete-faqs/{id}', [FaqsController::class, 'destroy'])->name('destroy.faq');

Route::post('/assign-ticket', [TicketController::class, 'assignTicket'])->name('assignTicket');