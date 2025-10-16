<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GamesController;

Route::get('/', function () {
    return view('welcome');
});

//Rota de inicio
Route::get('/home',[HomeController::class, 'index'])
    ->name('home.jogos');

//Rota de busca de jogos
Route::get('/busca', [GamesController::class, 'busca'])
    ->name('buscar.games');

//Rota de busca de jogos via post
Route::post('/games', [GamesController::class, 'buscarGames'])
    ->name('busca.games');

//Rota de busca de jogos similares post
Route::post('/similar', [GamesController::class, 'buscarSimilares'])
    ->name('busca.similares');

//Rota de busca de jogos similares
Route::get('/similar', [GamesController::class, 'similar'])
    ->name('games.similar');

//Jogo similar
Route::get('/jogo-similar', [GamesController::class, 'buscarSimilares'])
    ->name('games.jogo.similar');

//Rota de login
Route::get('/login',[LoginController::class,'index'])
    ->name('login.index');

//Rota de criação de usu
Route::get('/create',[LoginController::class, 'create'])
    ->name('login.create');

//Rota post de criar usuario
Route::post('/create', [LoginController::class, 'store'])
    ->name('login.store');  

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.login');

Route::post('/logout', [LoginController::class, 'Logout'])
    ->name('login.logout');