<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function exibirTela()
    {
        return view('auth.esqueci-senha');
    }

    public function mostrarFormulario(Request $request, $token)
    {
        return view('auth.nova-senha', [
            'token' => $token,
            'email' => $request->email
        ]);
    }
    public function enviarLinkReset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'Por favor, insira um e-mail válido.',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', 'O link para redefinição de senha foi enviado para o seu e-mail!');
        }


        return back()->withErrors([
            'email' => 'Não encontramos nenhum usuário com esse endereço de e-mail.'
        ])->withInput();
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $status = password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login.index')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
