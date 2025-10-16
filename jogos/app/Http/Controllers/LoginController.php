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

        $data['name'] = $request->input('name');
        $data['email'] = $request->input('email');
        $data['password'] = $request->password;
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

    public function login(Request $request){
        $login = $request->only('email', 'password');
        // dd($request->all());
        
        if(Auth::attempt($login)){
            $request->session()->regenerate();

            return to_route('buscar.games');
        }

        return to_route('login.index')->withErrors([
            'email' => 'O email ou a senha estão incorretos.',
        ])->onlyInput('email');
    }

    public function Logout(Request $request) {
        Auth::logout();

        return to_route("login.index");
    }
}
