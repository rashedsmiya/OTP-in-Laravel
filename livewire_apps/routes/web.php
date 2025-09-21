<?php

    use Illuminate\Support\Facades\Route;
    use Livewire\Volt\Volt;
    use App\Livewire\Posts\Index;
    
    Route::get('/', function () {
        return view('welcome');
    })->name('home');
    
    Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    
    Route::middleware(['auth'])->group(function () {
        Route::redirect('settings', 'settings/profile');
        
        Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
        Volt::route('settings/password', 'settings.password')->name('password.edit');
        Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');
        Route::get('/posts', Index::class)->name('posts.index');
        
    }); 
    
    require __DIR__.'/auth.php';  
