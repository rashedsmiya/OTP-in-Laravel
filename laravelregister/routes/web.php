<?php

    use App\Http\Controllers\ProfileController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\RegisterWithOtpController;
    use App\Http\Controllers\CustomProfileController;
    use App\Http\Controllers\LoginWithOtpController;
    
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::post('/profile/two-factor-auth', [CustomProfileController::class, 'store'])
    ->name('enable.two.factor.auth');
    }); 
   
   Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
       
        Route::get('register', [RegisterWithOtpController::class, 'create'])->name('register');
        Route::post('register', [RegisterWithOtpController::class, 'store']);
        Route::get('verify/otp', [RegisterWithOtpController::class, 'verifyOtp'])->name('verify.otp');
        Route::post('verify/otp/store', [RegisterWithOtpController::class, 'verifyOtpStore'])->name('verify.otp.store');
        Route::get('login', [LoginWithOtpController::class, 'create'])->name('login');
        Route::post('login/store', [LoginWithOtpController::class, 'store'])->name('login.store');
        Route::get('verify/otp/login', [LoginWithOtpController::class, 'verifyOtp'])->name('verify.otp.login');
        Route::post('verify/otp/login/store', [LoginWithOtpController::class, 'verifyOtpStore'])->name('verify.otp.login.store');
    });


    require __DIR__.'/auth.php';
