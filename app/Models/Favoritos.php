<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favoritos extends Model
{
    protected $primaryKey = [
        'user_id',
        'id_jogo'
    ];
    protected $fillable = [
        'user_id',
        'id_jogo'
    ];

    public function jogos()
    {
        return $this->belongsTo(Jogos::class, 'id_jogo');
    }
}
