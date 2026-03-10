<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AtendimentoOs extends Model
{
    use HasFactory;

    protected $table = 'atendimentos_os';

    protected $fillable = [
        'os_id',
        'admin_id',
        'relato_tecnico',
        'data_inicio',
        'data_fim'
    ];

    // O atendimento pertence a uma Ordem de Serviço
    public function ordemServico()
    {
        return $this->belongsTo(OrdemServico::class, 'os_id');
    }

    // O atendimento foi feito por um Admi
    public function tecnico()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}