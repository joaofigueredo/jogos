<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jogos extends Model
{
    protected $fillable = [
        'id',
        'nome',
        'duracao',
        'url_imagem',
        'id_jogador'
    ];
}