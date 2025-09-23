<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;

Route::get('/', [PublicController::class, 'home'])->name('homepage');


Route::middleware(['auth'])->group(function () {
    Route::get('/booking', [UserController::class, 'booking'])->name('user.booking');
});
