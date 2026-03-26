<?php

namespace App\Http\Controllers;

use App\Models\OrdemServico;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


class AdminController extends Controller
{

public function dashboard()
{

$stats = [

'total' => OrdemServico::count(),

'pendentes' => OrdemServico::where('status','Pendente')->count(),

'concluidas' => OrdemServico::where('status','Concluído')->count(),

];
$notificacoes = Notification::latest()->get(); 

return view('admin.dashboard', [
    'stats' => $stats,
    'notificacoes' => $notificacoes
]);

}


public function indexOs()
{

$ordens = OrdemServico::with('usuario')->latest()->get();

return $this->indexFiltro($ordens);

}


/* FILTROS */

public function pendentes()
{

$ordens = OrdemServico::with('usuario')
->where('status','Pendente')
->latest()
->get();

return $this->indexFiltro($ordens);

}


public function tratativa()
{

$ordens = OrdemServico::with('usuario')
->where('status','Em Tratativa')
->latest()
->get();

return $this->indexFiltro($ordens);

}


public function concluidas()
{

$ordens = OrdemServico::with('usuario')
->where('status','Concluído')
->latest()
->get();

return $this->indexFiltro($ordens);

}


/* FUNÇÃO BASE DA VIEW */

private function indexFiltro($ordens)
{

$total = OrdemServico::count();

$pendentes = OrdemServico::where('status','Pendente')->count();

$tratativa = OrdemServico::where('status','Em Tratativa')->count();

$concluidas = OrdemServico::where('status','Concluído')->count();

return view('admin.index',compact(

'ordens',

'total',

'pendentes',

'tratativa',

'concluidas'

));

}


// detalhes OS

public function show($id)
{

$os = OrdemServico::with('usuario')->findOrFail($id);

return view('admin.tratamento_os',compact('os'));

}


// update OS

public function update(Request $request,$id)
{
    $request->validate([
        'status' => 'required'
    ]);

    $os = OrdemServico::findOrFail($id);

    $statusAntigo = $os->status;
    $novoStatus = $request->status;

    // 👉 compara ANTES de salvar
    $mudou = $statusAntigo !== $novoStatus;

    $os->status = $novoStatus;
    $os->descricao = $request->descricao;
    $os->save();

    if($mudou){
        Notification::create([
            'user_id'=>$os->user_id,
            'mensagem'=>"Sua OS '{$os->titulo}' mudou para {$novoStatus}",
            'lida'=>false
        ]);
    }

    return redirect()
    ->route('admin.os.index')
    ->with('success','O.S atualizada');
}
public function exportarPdf()
{
    $ordens = OrdemServico::with('usuario')
        ->where('status','Concluído')
        ->get();

    $pdf = Pdf::loadView('relatorios.pdf', compact('ordens'));

    return $pdf->download('relatorio-os.pdf');
}
}