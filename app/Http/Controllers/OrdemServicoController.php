<?php

namespace App\Http\Controllers;

use App\Models\OrdemServico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdemServicoController extends Controller
{
    // Lista as OS do próprio usuário logado
    public function index()
    {
        $ordens = OrdemServico::where('user_id', Auth::id())->latest()->get();
        return view('usuarios.index', compact('ordens'));
    }

    // Exibe a tela de abertura (ajustado para sua pasta usuarios)
    public function create()
    {
        return view('usuarios.abertura-os');
    }

    public function store(Request $request)
    {
        // 1. Validação dos campos necessário
        $request->validate([
            'titulo' => 'required|max:100',
            'descricao' => 'required',
            'setor' => 'required',
            'categoria' => 'required|in:Hardware,Software,Rede,Outros',
            'equipamento' => 'nullable|max:100',
        ]);

        // 2. Criação da OS vinculada ao usuário logado
        OrdemServico::create([
            'user_id' => Auth::id(), 
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'setor' => $request->setor,
            'categoria' => $request->categoria,
            'equipamento' => $request->equipamento,
            'status' => 'Pendente', 
        ]);

        // Redireciona para a listagem com mensagem de sucesso
        return redirect()->route('os.index')->with('success', 'Ordem de Serviço aberta com sucesso!');
    }
}