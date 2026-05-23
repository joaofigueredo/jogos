<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $usuario_id = auth()->user()->id;
        // dd($usuario_id);
        $ultimo = DB::table('jogos')
            ->where('id_jogador', $usuario_id)
            ->orderBy('id', 'DESC')
            ->first();
        

        if($ultimo == null) {
            return view('home.index');
        }

        return view('home.index')->with('ultimo', $ultimo);
    }
}
