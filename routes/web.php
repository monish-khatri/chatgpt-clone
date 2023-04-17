<?php

use App\Http\Controllers\ChatGPTController;
use App\Http\Controllers\LoginWithGoogleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome');
})->middleware(['guest']);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Login With Google
Route::get('google', [LoginWithGoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('google/callback', [LoginWithGoogleController::class, 'handleGoogleCallback']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/chat/{id?}', [ChatGPTController::class, 'show'])->name('chat.show');
    Route::post('/chat/{id?}', [ChatGPTController::class, 'store'])->name('chat.store');
    Route::delete('/chat/{chat}', [ChatGPTController::class, 'destroy'])->name('chat.destroy');
    Route::delete('/chat/clear/all', [ChatGPTController::class, 'clear'])->name('chat.clear');
});

require __DIR__.'/auth.php';
