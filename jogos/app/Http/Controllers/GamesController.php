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

    public function buscarGames(Request $request){
        
        $query = $request->input('query', 'zelda');
        $query = $request->nome;

        $response = Http::withHeaders([
            'Client-ID' => $this->clientId,
            'Authorization' => 'Bearer ' . $this->accessToken,
            ])
            ->withOptions(['verify' => false]) 
            ->withBody("
                search\"$query\";
                fields name, cover.url, genres.name, platforms.name,summary, screenshots.url;
                limit 1;
            ", 'text/plain')->post('https://api.igdb.com/v4/games');
        
            $jogos = $response->json();

            dd($jogos);
            if (empty($jogos)) {
                return view('home.index')->with('mensagem', 'Nenhum jogo encontrado.');
            }
            
            return view('games.index')->with('jogos', $jogos);
        }
}