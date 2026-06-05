<?php

namespace App\Http\Controllers;

use App\Models\Favoritos;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoritosController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_jogo' => 'required|integer',
        ]);

        $user_id = Auth::id();
        $id_jogo = intval($request->id_jogo);

        $repeticaoFavorito = Favoritos::where('user_id', $user_id)
            ->where('id_jogo', $id_jogo)
            ->exists();

        $fav = Favoritos::all();

        if ($repeticaoFavorito || count($fav) >= 4) {
            return redirect()->back()->withErrors('Já atingiu o limite de 4 favoritos!');
        }


        DB::table('favoritos')->insert([
            'user_id' => $user_id,
            'id_jogo' => $id_jogo,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return redirect()->back()->with('sucesso', 'Jogo adicionado aos favoritos!');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        // dd($id);

        $favorito = DB::table('favoritos')
            ->where('user_id', Auth::id())
            ->where('id_jogo', $id)
            ->delete();

        return redirect()->back()->with('sucesso', 'Jogo removido dos favoritos!');
    }

    public function index()
    {
        try {
            $favoritos = DB::table('favoritos')
                ->where('user_id', auth()->id())
                ->pluck('id_jogo')
                ->toArray();
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }

        $jogos = DB::table('jogos')->whereIn('id', $favoritos)->get();

        return view('favoritos.index')
            ->with('jogos', $jogos);
    }
}