<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BudgetCategoryController;
use App\Http\Controllers\InventoryCategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/contact-us', function () {
    return view('contact');
})->name('contact');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])
    ->group(function() {
        Route::resource('budget_category', BudgetCategoryController::class);
        Route::resource('inventory_category', InventoryCategoryController::class);
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('user', UserController::class);
        Route::resource('budget', BudgetController::class);
        Route::resource('inventory', InventoryController::class);
    });