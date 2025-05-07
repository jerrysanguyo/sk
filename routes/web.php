<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BudgetCategoryController;
use App\Http\Controllers\InventoryCategoryController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/contact-us', function () {
    return view('contact');
})->name('contact');

Route::resource('budget_category', BudgetCategoryController::class);
Route::resource('inventory_category', InventoryCategoryController::class);