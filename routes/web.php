<?php

use App\Http\Controllers\ArtistiController;
use App\Http\Controllers\CanzoniController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EdizioniController;
use App\Http\Controllers\PremiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TipiArtistiController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [WelcomeController::class, 'index'])->name('/');
Route::post('/', [WelcomeController::class, 'index'])->name('changeEdizione');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('tipiArtisti', TipiArtistiController::class)->except('create','show','edit')->parameters(['tipiArtisti'=>'tipoArtista']);
    Route::resource('artisti', ArtistiController::class)->parameters(['artisti'=>'artista']);
    Route::resource('canzoni', CanzoniController::class)->except('show')->parameters(['canzoni'=>'canzone']);
    Route::get('canzoni/altro/{altro}/delete', [CanzoniController::class, 'deleteAltro'])->name('canzoni.altro.delete');
    Route::resource('edizioni', EdizioniController::class)->parameters(['edizioni'=>'edizione']);
    Route::get('edizioni/altro/{altro}/delete', [EdizioniController::class, 'deleteAltro'])->name('edizioni.altro.delete');
    Route::resource('premi', PremiController::class)->except(['show'])->parameters(['premi'=>'premio']);

    Route::resource('utenti', UsersController::class)->except(['show'])->parameters(['utenti'=>'utente']);
});

require __DIR__.'/auth.php';
