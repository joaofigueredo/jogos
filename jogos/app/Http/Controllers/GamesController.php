<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GamesController extends Controller
{
    private $clientId;
    private $clientSecret;
    private $accessToken;

    public function __construct()
    {
        $this->clientId = env('IGDB_CLIENT_ID');
        $this->clientSecret = env('IGDB_CLIENT_SECRET');
        $this->accessToken = null; // buscar token quando necessário
    }

    private function getAccessToken()
    {
        if (empty($this->clientId) || empty($this->clientSecret)) {
            \Log::error('IGDB credentials missing', ['client_id' => $this->clientId ? 'set' : 'missing']);
            return null;
        }

        $response = Http::asForm()
            ->withOptions(['verify' => false])
            ->post('https://id.twitch.tv/oauth2/token', [
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'grant_type' => 'client_credentials',
            ]);

        if (! $response->successful()) {
            \Log::error('Twitch token request failed', ['status' => $response->status(), 'body' => $response->body()]);
            return null;
        }

        $data = $response->json();
        return $data['access_token'] ?? null;
    }

    private function ensureAccessToken()
    {
        if (empty($this->accessToken)) {
            $this->accessToken = $this->getAccessToken();
            if (empty($this->accessToken)) {
                abort(500, 'Não foi possível obter access_token IGDB/Twitch. Verifique IGDB_CLIENT_ID/IGDB_CLIENT_SECRET.');
            }
        }
    }

    public function busca()
    {
        return view('games.busca');
    }

    public function buscarGames(Request $request)
    {
        $this->ensureAccessToken();

        $jogo = $request->input('nome', '');
        if (trim($jogo) === '') {
            return back()->withErrors(['erro' => 'Nome do jogo inválido.']);
        }

        $query = "search \"{$jogo}\";\nfields name, cover.url, genres.name, platforms.name, summary, similar_games;\nlimit 6;";

        $response = Http::withHeaders([
            'Client-ID' => $this->clientId,
            'Authorization' => 'Bearer ' . $this->accessToken,
        ])->withOptions(['verify' => false])
          ->withBody($query, 'text/plain')
          ->post('https://api.igdb.com/v4/games');

        if (! $response->successful()) {
            \Log::error('IGDB /games request failed', ['status' => $response->status(), 'body' => $response->body()]);
            return back()->withErrors(['erro' => 'Erro na busca de jogos.']);
        }

        $jogos = $response->json();

        if (empty($jogos)) {
            $mensagemErro = " '{$jogo}' não encontrado";
            return to_route('home.jogos')->withErrors(['erro' => $mensagemErro]);
        }

        return view('games.index')->with('jogos', $jogos);
    }

    public function similar()
    {
        return view('games.similar');
    }

    public function buscarSimilares(Request $request)
    {
        $this->ensureAccessToken();

        $nome = $request->input('nome', '');
        if (trim($nome) === '') {
            return back()->withErrors(['erro' => 'Nome do jogo inválido.']);
        }

        $query = "search \"{$nome}\";\nfields name, similar_games;\nlimit 6;";

        $response = Http::withHeaders([
            'Client-ID' => $this->clientId,
            'Authorization' => 'Bearer ' . $this->accessToken,
        ])->withOptions(['verify' => false])
          ->withBody($query, 'text/plain')
          ->post('https://api.igdb.com/v4/games');

        if (! $response->successful()) {
            \Log::error('IGDB search similar request failed', ['status' => $response->status(), 'body' => $response->body()]);
            return back()->withErrors(['erro' => 'Erro na busca de jogos similares.']);
        }

        $nomeJogo = $response->json();
        if (empty($nomeJogo) || !isset($nomeJogo[0]['similar_games']) || !is_array($nomeJogo[0]['similar_games']) || count($nomeJogo[0]['similar_games']) === 0) {
            $mensagemErro = " '{$nome}' não possui jogos similares encontrados";
            return to_route('games.similar')->withErrors(['erro' => $mensagemErro]);
        }

        $similarGames = $nomeJogo[0]['similar_games'];
        $count = count($similarGames);
        $n = rand(0, $count - 1);
        $jogoId = intval($similarGames[$n]);

        // $query2 = "where id = {$jogoId};\nfields name, cover.url, genres.name, platforms.name;\nlimit 1;";

        $response = Http::withHeaders([
            'Client-ID' => $this->clientId,
            'Authorization' => 'Bearer ' . $this->accessToken,
        ])->withOptions(['verify' => false])
          ->withBody("where id = {$jogoId};
            fields name, cover.url, genres.name, platforms.name;
            limit 1;"
            , 'text/plain')
          ->post('https://api.igdb.com/v4/games');

        if (! $response->successful()) {
            \Log::error('IGDB /games by id failed', ['status' => $response->status(), 'body' => $response->body()]);
            return back()->withErrors(['erro' => 'Erro ao buscar jogo similar.']);
        }

        $jogo1 = $response->json();
        if (empty($jogo1)) {
            return to_route('games.similar')->withErrors(['erro' => 'Jogo similar não encontrado.']);
        }

        return view('games.jogo-similar')->with('jogo1', $jogo1);
    }
}
