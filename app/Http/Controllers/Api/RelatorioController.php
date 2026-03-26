<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrdemServico;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{

    // 📊 RESUMO GERAL
    public function resumo()
    {
        return response()->json([
            'total' => OrdemServico::count(),
            'pendentes' => OrdemServico::where('status','Pendente')->count(),
            'tratativa' => OrdemServico::where('status','Em Tratativa')->count(),
            'concluidas' => OrdemServico::where('status','Concluído')->count(),
        ]);
    }

    // ✅ OS CONCLUÍDAS
    public function concluidas()
    {
        $dados = OrdemServico::with('usuario')
            ->where('status','Concluído')
            ->latest()
            ->get();

        return response()->json([
            'total' => $dados->count(),
            'dados' => $dados
        ]);
    }

    // 📊 POR STATUS
    public function porStatus()
    {
        return response()->json([
            'Pendente' => OrdemServico::where('status','Pendente')->count(),
            'Em Tratativa' => OrdemServico::where('status','Em Tratativa')->count(),
            'Concluído' => OrdemServico::where('status','Concluído')->count(),
        ]);
    }

    // 👤 POR USUÁRIO
    public function porUsuario()
    {
        $dados = OrdemServico::with('usuario')
            ->get()
            ->groupBy('user_id')
            ->map(function($items){
                return [
                    'usuario' => $items->first()->usuario->name,
                    'total' => $items->count()
                ];
            });

        return response()->json($dados->values());
    }

    // 📅 POR PERÍODO
    public function porPeriodo(Request $request)
    {
        $request->validate([
            'inicio' => 'required|date',
            'fim' => 'required|date'
        ]);

        $dados = OrdemServico::with('usuario')
            ->whereBetween('created_at', [$request->inicio, $request->fim])
            ->get();

        return response()->json([
            'total' => $dados->count(),
            'dados' => $dados
        ]);
    }
}