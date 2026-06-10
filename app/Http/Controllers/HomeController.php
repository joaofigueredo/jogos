<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

class HomeController extends Controller
{
    public function index()
    {
        $usuario_id = auth()->user()->id;
        // dd($usuario_id);

        $jogos = DB::table('jogos')->count();

        $ultimos = DB::table('jogos')
            ->where('id_jogador', $usuario_id)
            ->orderBy('id', 'DESC')
            ->take(3)
            ->get();
        // dd($ultimos);

        if ($ultimos == null) {
            return view('home.index');
        }

        return view('home.index')->with('ultimos', $ultimos)->with('jogos', $jogos);
    }
}
