<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class GamesController extends Controller
{
    private $clientId;
    private $clientSecret;
    private $accessToken;

    public function __construct() {
        $this->clientId = env('IGDB_CLIENT_ID');
        $this->clientSecret = env('IGDB_CLIENT_SECRET');
        $this->accessToken = $this->getAccessToken();
    }


    private function getAccessToken() {
        $response = Http::asForm()
        ->withOptions(['verify' => false])
        ->post('https://id.twitch.tv/oauth2/token', [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'grant_type' => 'client_credentials',
        ]);

        return $response->json()['access_token'];
    }

    public function busca() {
        return view('games.busca');
    }

    public function buscarGames(Request $request) {
        $jogo = $request->nome;

        $response = Http::withHeaders([
            'Client-ID' => $this->clientId,
            'Authorization' => 'Bearer ' . $this->accessToken,
            ])
            ->withOptions(['verify' => false]) 
            ->withBody("
                search\"$jogo\";
                fields name, cover.url, genres.name, platforms.name, summary, similar_games;
                limit 6;
            ", 'text/plain')->post('https://api.igdb.com/v4/games');
        
            $jogos = $response->json();

     

            if (empty($jogos)) {
                $mensagemErro = " '$jogo' não encontrado";
                return to_route('home.jogos')->withErrors(['erro' => $mensagemErro]);
            }
            
            return view('games.index')->with('jogos', $jogos);
        }

        public function similar() {
            return view('games.similar');
        }

        public function buscarSimilares(Request $request) {
            $nome = $request->nome;

            $response = Http::withHeaders([
            'Client-ID' => $this->clientId,
            'Authorization' => 'Bearer ' . $this->accessToken,
            ])
            ->withOptions(['verify' => false]) 
            ->withBody("
                search\"$nome\";
                fields name, cover.url, genres.name, platforms.name, summary, similar_games;
                limit 6;
            ", 'text/plain')->post('https://api.igdb.com/v4/games');

            if(empty($response->json())) {
                $mensagemErro = " '$nome' não encontrado";
                return to_route('games.similar')->withErrors(['erro' => $mensagemErro]);
            }
        
            $nomeJogo = $response->json();
            $n = rand(1, 5);
            $jogo = $nomeJogo[0]['similar_games'][$n];

            $response = Http::withHeaders([
            'Client-ID' => $this->clientId,
            'Authorization' => 'Bearer ' . $this->accessToken,
            ])
            ->withOptions(['verify' => false]) 
            ->withBody("
                where id = ($jogo);
                fields name, cover.url, genres.name, platforms.name;
                limit 1;
            ", 'text/plain')->post('https://api.igdb.com/v4/games');

            $jogo1 = $response->json();

            // dd($jogo1);

            return view('games.jogo-similar')
                ->with('jogo1', $jogo1);
        }
}