<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\BucketsController;
use App\Http\Controllers\AppUserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\LoginController;

// Public routes
Route::get('/', [LandingPageController::class, 'index']);
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('/registration', [AppUserController::class, 'index'])->name('registration.index');
Route::post('/registration', [AppUserController::class, 'store'])->name('register');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected routes accessible by any logged-in user
Route::middleware(['auth.session'])->group(function () {
    Route::resource('transactions', TransactionsController::class);
    Route::post('/transactions/import', [TransactionsController::class, 'import'])->name('transactions.import');
    Route::resource('buckets', BucketsController::class);
    Route::get('/reports/{year?}', [ReportController::class, 'showReport'])->name('reports.index');
});

// Admin-only routes, now specifically protected with 'admin.only' middleware
Route::middleware(['auth.session', 'admin.only'])->group(function () {
    Route::get('/userlist', [UserListController::class, 'index'])->name('admin.userlist');
    Route::post('/userlist/{userId}/updateStatus', [UserListController::class, 'updateStatus'])->name('userlist.updateStatus');
});
