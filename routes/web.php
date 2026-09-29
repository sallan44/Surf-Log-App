<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpotController;
use App\Http\Controllers\SurfSessionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\FeedController;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('feed', [FeedController::class, 'index'])->name('feed');

Route::middleware('auth')->group(function () {
    Route::resource('spots', SpotController::class);
    Route::resource('boards', BoardController::class);
    Route::resource('tags', TagController::class);
    Route::resource('sessions', SurfSessionController::class)->parameters(['sessions' => 'surf_session']); //Laravel's implicit route-model-binding matches the URI segment name to controller method's parameter name

    // ->parameters(['breaks' => 'spot']);
});

require __DIR__.'/auth.php';