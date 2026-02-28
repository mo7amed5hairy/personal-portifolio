<?php

use App\Http\Controllers\PublicController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

// Redirect root to default locale
Route::get('/', function () {
    return redirect('/ar');
});

// Locale group
Route::prefix('{locale}')
    ->where(['locale' => 'ar|en'])
    ->middleware(SetLocale::class)
    ->group(function () {
        
    Route::get('/', [PublicController::class, 'index'])->name('home');
    
    // Switch language route
    Route::get('switch/{to}', function ($locale, $to) {
        // Redirect to home with new locale
        return redirect()->route('home', ['locale' => $to]);
    })->name('switch.language');
});

// Admin routes (no locale)
Route::prefix('admin')->name('admin.')->group(function () {
    // Auth routes (public)
    Route::get('login', [\App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [\App\Http\Controllers\Admin\AuthController::class, 'login']);
    
    // Protected routes
    Route::middleware('auth')->group(function () {
        Route::post('logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
        Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('dashboard');
        Route::resource('projects', \App\Http\Controllers\Admin\ProjectController::class);
        Route::resource('sections', \App\Http\Controllers\Admin\SectionController::class);
        Route::resource('courses', \App\Http\Controllers\Admin\CourseController::class);
        Route::get('bio', [\App\Http\Controllers\Admin\BioController::class, 'edit'])->name('bio.edit');
        Route::put('bio', [\App\Http\Controllers\Admin\BioController::class, 'update'])->name('bio.update');
    });
});

// Laravel expects a 'login' route for auth redirects
Route::get('login', function () {
    return redirect()->route('admin.login');
})->name('login');
