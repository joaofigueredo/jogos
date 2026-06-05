<?php

namespace App\Http\Controllers;

use App\Models\Favoritos;
use App\Models\Jogos;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{

    public function index()
    {
        return view("login.index");
    }

    public function create()
    {
        return view("login.create");
    }

    public function store(Request $request)
    {

        $request->input('name') ? $data['name'] = $request->input('name') : dd('Nome invalido');
        $request->input('email') ? $data['email'] = $request->input('email') : dd('email invalido');
        $request->input('password') ? $data['password'] = $request->password : dd('senha invalida');
        $data['idPs'] = $request->idPs;
        $data['idXbox'] = $request->idXbox;

        $data['password'] = Hash::make($data['password']);

        $user = User::create([
            'name' => $data['name'],
            'email' =>  $data['email'],
            'password' => $data['password'],
            'idPs' => $data['idPs'],
            'idXbox' => $data['idXbox']
        ]);

        Auth::login($user);

        return to_route('busca.games');
    }

    public function login(Request $request)
    {
        $login = $request->only('email', 'password');

        if (Auth::attempt($login)) {
            $request->session()->regenerate();
            $usuario = Auth::user();

            return to_route('buscar.games')
                ->with('sucesso', "Olá, $usuario->name!");
        }

        return to_route('login.index')->withErrors([
            'email' => 'O email ou a senha estão incorretos.',
        ])->onlyInput('email');
    }

    public function Logout(Request $request)
    {
        Auth::logout();

        return to_route("login.index");
    }

    public function perfil()
    {
        $favoritos = DB::table('favoritos')
            ->where('user_id', auth()->id())
            ->take(4)
            ->pluck('id_jogo')
            ->toArray();

        $jogos = Jogos::whereIn('id', $favoritos)
            ->get();


        $usuario = Auth::user();

        return view("login.perfil")
            ->with('usuario', $usuario)
            ->with('jogos', $jogos);
    }

    public function update(Request $request)
    {
        User::where('id', Auth::user()->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'idPs' => $request->idPs,
                'idXbox' => $request->idXbox
            ]);

        return to_route("login.perfil")
            ->with('sucesso', 'Perfil atualizado com sucesso!');
    }
}
