<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $ultimo = DB::table('jogos')
            ->orderBy('id', 'DESC')
            ->first();
        
        
        // dd($ultimo);

        if($ultimo == null) {
            return view('home.index');
        }

        return view('home.index')->with('ultimo', $ultimo);
    }
}
