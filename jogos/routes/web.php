<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GamesController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home',[HomeController::class, 'index'])
    ->name('home.jogos');

Route::get('/games', [GamesController::class, 'buscarGames'])
    ->name('games');

Route::post('/games', [GamesController::class, 'buscarGames'])
    ->name('busca.games');