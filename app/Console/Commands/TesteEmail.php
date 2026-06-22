<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Password;

class TesteEmail extends Command
{
    protected $signature = 'email:teste {email : Email do usuário para testar}';
    protected $description = 'Testa o envio de email de reset de senha';

    public function handle()
    {
        $email = $this->argument('email');

        $this->info("Testando envio de email de reset de senha para: {$email}");

        try {
            // Busca o usuário
            $user = User::where('email', $email)->first();

            if (!$user) {
                $this->error("Usuário com email {$email} não encontrado!");
                return 1;
            }

            $this->info("Usuário encontrado: {$user->name}");

            // Envia o link de reset
            $status = Password::sendResetLink(
                ['email' => $email]
            );

            if ($status === Password::RESET_LINK_SENT) {
                $this->info('✓ Email de reset enviado com sucesso!');
                return 0;
            } else {
                $this->error('✗ Falha ao enviar email de reset');
                $this->line("Status: {$status}");
                return 1;
            }
        } catch (\Exception $e) {
            $this->error("Erro ao enviar email: " . $e->getMessage());
            $this->line("Stack trace: " . $e->getTraceAsString());
            return 1;
        }
    }
}
