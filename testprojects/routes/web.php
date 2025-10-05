<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TestViewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-view', [TestViewController::class, 'test'])->name('test_view');
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
