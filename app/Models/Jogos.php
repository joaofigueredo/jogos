<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jogos extends Model
{
    protected $primaryKey = 'id_jogo';
    protected $fillable = [
        'id_jogo',
        'nome',
        'duracao',
        'url_imagem',
        'id_jogador',
        'critica'
    ];
}
