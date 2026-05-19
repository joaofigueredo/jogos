<?php

namespace App\Http\Controllers;

use App\Models\Favoritos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoritosController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'id_jogo' => 'required|integer',
        ]);

        $user_id = Auth::id();
        $id_jogo = intval($request->id_jogo);

        // dd($user_id, $id_jogo);

        $repeticaoFavorito = Favoritos::where('user_id', $user_id)
            ->where('id_jogo', $id_jogo)
            ->exists();

        if ($repeticaoFavorito >= 4) {
            return redirect()->back()->withErrors('Já atingiu o limite de 4 favoritos!');
        }

        // Favoritos::create([
        //     'user_id' => $user_id,
        //     'id_jogo' => $id_jogo
        // ]);

        DB::table('favoritos')->insert([
            'user_id' => $user_id,
            'id_jogo' => $id_jogo,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return redirect()->back()->with('sucesso', 'Jogo adicionado aos favoritos!');
    }

    public function destroy(Request $id)
    {
        $favorito = Favoritos::where('user_id', Auth::id())->findOrFail($id);
        $favorito->delete();

        return redirect()->back()->with('sucesso', 'Jogo removido dos favoritos!');
    }
}
