<?php

use App\Http\Controllers\TestViewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [TestViewController::class, 'test']);
