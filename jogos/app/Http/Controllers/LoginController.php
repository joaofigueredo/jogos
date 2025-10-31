<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function index() {
        return view("login.index");
    }

    public function create() {
        return view("login.create");
    }

    public function store(Request $request) {
        
        // dd($request->all());
        
        $request->input('name') ? $data['name'] = $request->input('name') : dd('Nome invalido');
        $request->input('email') ? $data['email'] = $request->input('email') : dd('email invalido');
        $request->input('password') ? $data['password'] = $request->password : dd('senha invalida');
        $data['idPs'] = $request->idPs;
        $data['idXbox'] = $request->idXbox;

        $data['password'] = Hash::make($data['password']);

        dd("Teste");

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

    public function login(Request $request){
        $login = $request->only('email', 'password');
        // dd($request->all());
        
        if(Auth::attempt($login)){
            $request->session()->regenerate();
            $usuario = Auth::user();
            // dd($usuario);
            return to_route('buscar.games')->with('mensagemSucesso', "Olá, $usuario->name!");
        }

        return to_route('login.index')->withErrors([
            'email' => 'O email ou a senha estão incorretos.',
        ])->onlyInput('email');
    }

    public function Logout(Request $request) {
        Auth::logout();

        return to_route("login.index");
    }

    public function perfil() {
        $usuario = Auth::user();
        // dd($usuario->idPs);
        return view("login.perfil")
            ->with('usuario', $usuario);
    }

    public function update(Request $request) {
        User::where('id', Auth::user()->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'idPs' => $request->idPs,
                'idXbox' => $request->idXbox
            ]);
        
        $mensagemSucesso = "Perfil atualizado com sucesso!";
        return to_route("login.perfil")->with('mensagemSucesso', $mensagemSucesso);
    }
}