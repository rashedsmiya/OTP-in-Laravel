<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\LoginWithGoogleController;

use App\Http\Controllers\LoginWithFacebookController;


use App\Http\Controllers\GithubController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/home', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');
Route::post('/home','HomeController@profileUpdate')->name('profileupdate');
Route::post('/home', [HomeController::class, 'profileupdate'])->middleware(['auth', 'verified'])->name('profileupdate');


Route::get('/home', [HomeController::class, 'profileUpdateform'])->middleware(['auth', 'verified'])->name('profileupdateform');

Route::get('/getalluser', [HomeController::class, 'getalluser'])->middleware(['auth', 'verified'])->name('getalluser');

Route::get('authorized/google', [LoginWithGoogleController::class, 'redirectToGoogle']);
Route::get('authorized/google/callback', [LoginWithGoogleController::class, 'handleGoogleCallback']);


Route::get('/redirect', [LoginWithFacebookController::class, 'redirectFacebook']);
Route::get('/callback', [LoginWithFacebookController::class, 'facebookCallback']);

Route::controller(GithubController::class)->group(function(){
    Route::get('auth/github', 'redirectToGithub')->name('auth.github');
    Route::get('auth/github/callback', 'handleGithubCallback');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
