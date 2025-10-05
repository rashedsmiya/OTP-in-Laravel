<?php

use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/file', function () {
    return view('fileUpload');
});
// Route::get('stripe', [StripeController::class, 'index']);
// Route::post('stripe', [StripeController::class, 'charge'])->name('stripe.change');
