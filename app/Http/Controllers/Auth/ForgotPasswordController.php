<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function exibirTela()
    {
        // Retorna a view que criamos (ajuste o caminho se salvou em outra pasta)
        return view('auth.esqueci-senha');
    }

    public function mostrarFormulario(Request $request, $token)
    {
        return view('auth.nova-senha', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    /**
     * Recebe o e-mail do formulário e dispara o reset via SMTP.
     */
    public function enviarLinkReset(Request $request)
    {
        // 1. Valida se o campo e-mail foi enviado e se tem formato válido
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'Por favor, insira um e-mail válido.',
        ]);

        // 2. O Facade Password faz a mágica: ele verifica se o usuário existe,
        // cria o token na tabela 'password_reset_tokens' e dispara o e-mail.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // 3. Verifica se o e-mail foi enviado com sucesso
        if ($status === Password::RESET_LINK_SENT) {
            // Retorna para a mesma página com uma mensagem de sucesso
            return back()->with('status', 'O link para redefinição de senha foi enviado para o seu e-mail!');
        }

        // 4. Se deu erro (ex: e-mail não encontrado no banco), retorna com o erro
        return back()->withErrors([
            'email' => 'Não encontramos nenhum usuário com esse endereço de e-mail.'
        ])->withInput(); // Mantém o e-mail digitado no campo
    }
}