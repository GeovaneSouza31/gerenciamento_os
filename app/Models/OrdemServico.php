<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrdemServico extends Model
{
    use HasFactory;

    protected $table = 'ordens_servico';

    protected $fillable = [
        'user_id',
        'titulo',
        'descricao',
        'setor',
        'categoria',
        'equipamento',
        'status'
    ];

    // a OS pertence a um Usuário
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relacionamento 1 para 1
    public function atendimento()
    {
        return $this->hasOne(AtendimentoOs::class, 'os_id');
    }
}