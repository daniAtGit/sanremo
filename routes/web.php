<?php

use App\Http\Controllers\ArtistiController;
use App\Http\Controllers\CanzoniController;
use App\Http\Controllers\EdizioniController;
use App\Http\Controllers\PremiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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

    Route::resource('artisti', ArtistiController::class)->parameters(['artisti'=>'artista']);
    Route::resource('canzoni', CanzoniController::class)->parameters(['canzoni'=>'canzone']);
    Route::resource('edizioni', EdizioniController::class)->parameters(['edizioni'=>'edizione']);
    Route::resource('premi', PremiController::class)->except(['show'])->parameters(['premi'=>'premio']);

    Route::resource('utenti', UsersController::class)->except(['show'])->parameters(['utenti'=>'utente']);
});

require __DIR__.'/auth.php';
