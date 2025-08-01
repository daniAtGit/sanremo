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

//Route::get('/', fn() => to_route('login'));

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', fn() => to_route('welcome'));
Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome');

Route::post('/welcome-cambia-edizione', [WelcomeController::class, 'index'])->name('changeEdizione');
Route::post('/welcome-cerca', [WelcomeController::class, 'cerca'])->name('cerca');
Route::post('welcome/get-logo', [WelcomeController::class, 'getLogo'])->name('welcome.getLogo');
Route::post('welcome/get-scenografia', [WelcomeController::class, 'getScenografia'])->name('welcome.getScenografia');
Route::post('welcome/get-videos', [WelcomeController::class, 'getVideos'])->name('welcome.getVideos');

Route::get('/welcome/artista/{id}', [WelcomeController::class, 'artistaShow'])->name('welcome.artista.show');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('tipiArtisti', TipiArtistiController::class)->except('create','show','edit')->parameters(['tipiArtisti'=>'tipoArtista']);
    Route::resource('artisti', ArtistiController::class)->parameters(['artisti'=>'artista']);
    Route::post('artista-get-foto', [ArtistiController::class, 'getFotoArtista'])->name('artista.getFoto');
    Route::resource('canzoni', CanzoniController::class)->except('show')->parameters(['canzoni'=>'canzone']);
    Route::get('canzoni/altro/{altro}/delete', [CanzoniController::class, 'deleteAltro'])->name('canzoni.altro.delete');

    Route::resource('edizioni', EdizioniController::class)->parameters(['edizioni'=>'edizione']);
    Route::get('edizioni/altro/{altro}/delete', [EdizioniController::class, 'deleteAltro'])->name('edizioni.altro.delete');
    Route::post('edizione-get-video', [EdizioniController::class, 'getVideo'])->name('edizione.getVideo');

    Route::resource('premi', PremiController::class)->except(['show'])->parameters(['premi'=>'premio']);

    Route::resource('utenti', UsersController::class)->except(['show'])->parameters(['utenti'=>'utente']);
});

require __DIR__.'/auth.php';
