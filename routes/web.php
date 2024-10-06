<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UrlController;


Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::get('/login', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard'); // Redirect to dashboard if already logged in
    }
    return view('login');
})->name('login');

Route::get('/register', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard'); // Redirect to dashboard if already logged in
    }
    return view('register');
})->name('register');


Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UrlController::class, 'index'])->name('dashboard');
    Route::post('/urls', [UrlController::class, 'store'])->name('urls.store');
});

Route::get('/{shortUrl}', [UrlController::class, 'show'])->name('urls.show');
