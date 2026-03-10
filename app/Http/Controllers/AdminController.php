<?php

namespace App\Http\Controllers;

use App\Models\OrdemServico;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Exibe o painel principal do administrador com estatísticas.
     */
    public function dashboard()
    {
        // Contagem dos dados para os cards que criamos na view admin/dashboard
        $stats = [
            'total'      => OrdemServico::count(),
            'pendentes'  => OrdemServico::where('status', 'Pendente')->count(),
            'concluidas' => OrdemServico::where('status', 'Concluído')->count(),
        ];

        // Retorna a view dentro da pasta admin/dashboard.blade.php
        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Lista todas as ordens de serviço do sistema para o admin.
     */
    public function indexOs()
    {
        // Pega todas as OS e já traz os dados do Usuário dono (Eager Loading)
        $ordens = OrdemServico::with('usuario')->latest()->get();
        
        return view('admin.index', compact('ordens'));
    }
// exibe os detalhes da os para o admin tratar
public function show($id)
{
    $os = OrdemServico::with('usuario')->findOrFail($id);
    return view('admin.tratamento_os', compact('os'));
}

// salva a alteração de status e descrição técnica
public function update(Request $request, $id)
{
    $os = OrdemServico::findOrFail($id);
    
    $os->update([
        'status' => $request->status,
        'descricao' => $request->descricao // aqui o admin pode atualizar o que foi feito
    ]);

    return redirect()->route('admin.os.index')->with('success', 'O.S. atualizada com sucesso!');
}
}