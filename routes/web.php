<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
};


Route::get('/', function(){
    return 'ok';
})->name('welcome');

Route::get('/dashboard', [ProfileController::class, 'index'])->name('dashboard');
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';