<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\FavoritosController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GamesController;
use App\Http\Middleware\ValidarLogin;
use App\Mail\ResetarSenhaEmail;
use App\Notifications\CustomResetPassword;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});

//rotas que so tem acesso ao realizar login
Route::middleware(ValidarLogin::class)->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home.jogos');
    Route::get('/busca', [GamesController::class, 'busca'])
        ->name('buscar.games');


    Route::get('/perfil', [LoginController::class, 'perfil'])
        ->name('login.perfil');

    Route::post('/perfil/update', [loginController::class, 'update'])
        ->name('login.update');

    Route::post('/adicionarJogo', [GamesController::class, 'adicionarJogo'])
        ->name('adicionar');

    Route::get('/listajogos', [GamesController::class, 'listajogos'])
        ->name('games.listajogos');

    Route::delete('/deletarJogo', [GamesController::class, 'destroy'])
        ->name('games.destroy');

    Route::post('/buscarjogo', [GamesController::class, 'buscar'])
        ->name('games.buscar');



    Route::get('/show/{id}', [GamesController::class, 'show'])
        ->name('games.show');

    Route::get('/estatisticas', [GamesController::class, 'estatisticas'])
        ->name('games.estatisticas');
    //Rota de busca de jogos via post
    Route::post('/games', [GamesController::class, 'buscarGames'])
        ->name('busca.games');
    //Rota de busca de jogos similares post
    Route::post('/similar', [GamesController::class, 'buscarSimilares'])
        ->name('busca.similares');

    //Jogo similar
    Route::get('/jogo-similar', [GamesController::class, 'buscarSimilares'])
        ->name('games.jogo.similar');
    //Rota de busca de jogos similares
    Route::get('/similar', [GamesController::class, 'similar'])
        ->name('games.similar');

    Route::post('/favoritar', [FavoritosController::class, 'store'])
        ->name('games.favorito');

    Route::post('/destroyFavorito', [FavoritosController::class, 'destroy'])
        ->name('favoritos.destroy');

    Route::get('/favoritos', [FavoritosController::class, 'index'])
        ->name('favoritos.index');

    Route::post('/finalizado', [GamesController::class, 'finalizarJogo'])
        ->name('games.finalizar');
});


//Rota de login
Route::get('/login', [LoginController::class, 'index'])
    ->name('login.index');

//Rota de criação de usuario
Route::get('/create', [LoginController::class, 'create'])
    ->name('login.create');

//Rota post de criar usuario
Route::post('/create', [LoginController::class, 'store'])
    ->name('login.store');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.login');

Route::post('/logout', [LoginController::class, 'Logout'])
    ->name('login.logout');

// Rota para exibir a tela (View)
Route::get('/esqueci-senha', [ForgotPasswordController::class, 'exibirTela'])
    ->name('password.request');

// Rota para processar o clique do botão (POST)
Route::post('/esqueci-senha', [ForgotPasswordController::class, 'enviarLinkReset'])
    ->name('password.email');

Route::get('/nova-senha/{token}', [ForgotPasswordController::class, 'mostrarFormulario'])
    ->name('password.reset');

Route::post('/reset-senha', [ForgotPasswordController::class, 'resetPassword'])
    ->name('password.update');