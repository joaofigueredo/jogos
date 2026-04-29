<?php

namespace App\Http\Controllers;

use App\Models\Jogos;
use DB;
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
        $this->accessToken = null;
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

        if (!$response->successful()) {
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

        $query = "search \"{$jogo}\";\nfields cover.url, name, genres.name, platforms.name, summary, similar_games;\nlimit 3;";

        $response = Http::withHeaders([
            'Client-ID' => $this->clientId,
            'Authorization' => 'Bearer ' . $this->accessToken,
        ])->withOptions(['verify' => false])
            ->withBody($query, 'text/plain')
            ->post('https://api.igdb.com/v4/games');

        if (!$response->successful()) {
            \Log::error('IGDB /games request failed', ['status' => $response->status(), 'body' => $response->body()]);
            return back()->withErrors(['erro' => 'Erro na busca de jogos.']);
        }

        $jogos = $response->json();


        if (empty($jogos)) {
            $mensagemErro = " '{$jogos}' não encontrado";
            return to_route('home.jogos')
                ->withErrors(['erro' => $mensagemErro]);
        }

        // dd($jogos[1]['name']);
        return view('games.index')
            ->with('jogos', $jogos);
    }

    public function similar()
    {
        return view('games.similar');
    }

    public function buscarSimilares(Request $request)
    {
        $this->ensureAccessToken();

        $nome = $request->nome;



        $query = "search \"*{$nome}*\";\nfields name, similar_games;\nlimit 2;";

        $response = Http::withHeaders([
            'Client-ID' => $this->clientId,
            'Authorization' => 'Bearer ' . $this->accessToken,
        ])->withOptions(['verify' => false])
            ->withBody($query, 'text/plain')
            ->post('https://api.igdb.com/v4/games');



        if (!$response->successful()) {
            \Log::error('IGDB search similar request failed', ['status' => $response->status(), 'body' => $response->body()]);
            return back()->withErrors(['erro' => 'Erro na busca de jogos similares.']);
        }

        $nomeJogo = $response->json();
        if (empty($nomeJogo) || !isset($nomeJogo[0]['similar_games']) || !is_array($nomeJogo[0]['similar_games']) || count($nomeJogo[0]['similar_games']) === 0) {
            $mensagemErro = " '{$nome}' não possui jogos similares encontrados";
            return to_route('games.similar')->withErrors(['erro' => $mensagemErro]);
        }

        $jogosimilar = $nomeJogo[0]['similar_games'];

        $count = count($jogosimilar);
        $n = rand(0, $count - 1);
        $jogoId = intval($jogosimilar[$n]);


        $response = Http::withHeaders([
            'Client-ID' => $this->clientId,
            'Authorization' => 'Bearer ' . $this->accessToken,
        ])->withOptions(['verify' => false])
            ->withBody(
                "where id = {$jogoId};
            fields name, cover.url, genres.name, platforms.name;
            limit 1;",
                'text/plain'
            )
            ->post('https://api.igdb.com/v4/games');

        if (!$response->successful()) {
            \Log::error('IGDB /games by id failed', ['status' => $response->status(), 'body' => $response->body()]);
            return back()->withErrors(['erro' => 'Erro ao buscar jogo similar.']);
        }


        $jogo1 = $response->json();
        if (empty($jogo1)) {
            return to_route('games.similar')
                ->withErrors(['erro' => 'Jogo similar não encontrado.']);
        }

        return view('games.jogo-similar')
            ->with('jogo1', $jogo1);
    }


    public function adicionarJogo(Request $request)
    {
        $jogo = $request->nome;
        // dd($request->critica);


        $jogoCriado = Jogos::create([
            'id_jogo' => $request->id_jogo,
            'id_jogador' => $request->idJogador,
            'nome' => $request->nome,
            'duracao' => 0,
            'url_imagem' => $request->cover,
            'critica' => $request->critica
        ]);

        // dd($jogoCriado);

        return to_route('games.listajogos')
            ->with('mensagemSucesso', "$jogo adicionado a sua conta!");
    }

    public function listajogos()
    {
        $jogos = DB::table('jogos')->get();

        return view('games.listajogos')
            ->with('jogos', $jogos);
    }

    public function destroy(Request $request)
    {
        // dd($request->all());
        $jogo = Jogos::where('id', '=', $request->id)
            ->delete();

        // dd($jogo);


        return to_route('games.listajogos')
            ->with('mensagemSucesso', "Jogo removido com sucesso!");
    }

    public function buscar(Request $request)
    {
        // dd($request->id);
        $buscar = $request->nome;
        $jogo = Jogos::where('nome', 'ILIKE', "%$buscar%")->get();
        // dd($jogo);

        return view('games.show')->with('jogo', $jogo);
    }
}
