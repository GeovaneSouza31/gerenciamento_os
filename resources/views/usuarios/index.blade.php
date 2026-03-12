@extends('layout.main')

@section('title', 'Meus Chamados')

@section('content')

<style>
    body {
        margin: 0;
        background: linear-gradient(135deg,#0f2027,#203a43,#2c5364);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: white;
        min-height: 100vh;
    }

    .container {
        padding: 40px 20px;
        max-width: 1100px;
        margin: 0 auto;
    }

    /* Card com animação de entrada suave (mesma da tela de abertura) */
    .glass-card {
        background: rgba(255, 255, 255, 0.07);
        backdrop-filter: blur(15px);
        padding: 40px;
        border-radius: 25px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        animation: fadeInPop 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    @keyframes fadeInPop {
        from { opacity: 0; transform: scale(0.9) translateY(30px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }

    .header-flex {
        display: flex; 
        justify-content: space-between; 
        align-items: center;
        margin-bottom: 10px;
        gap: 20px;
    }

    .header-flex h2 {
        font-size: 28px;
        margin: 0;
    }

    .subtitle {
        color: #cfe8ff;
        margin-bottom: 35px;
        font-size: 15px;
        opacity: 0.9;
    }

    /* Wrapper para Tabela Responsiva */
    .table-responsive {
        width: 100%;
        overflow-x: auto;
        border-radius: 15px;
        background: rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    /* Estilização da Tabela */
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 750px;
    }

    .custom-table thead tr {
        background: rgba(255, 255, 255, 0.05);
        text-align: left;
    }

    .custom-table th {
        padding: 18px 15px;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #00c6ff;
    }

    .custom-table td {
        padding: 18px 15px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        font-size: 15px;
        transition: 0.3s;
    }

    /* Efeito de Hover nas Linhas */
    .custom-table tbody tr {
        transition: 0.3s;
    }

    .custom-table tbody tr:hover {
        background: rgba(255, 255, 255, 0.05);
        transform: scale(1.005);
        box-shadow: inset 4px 0 0 #00c6ff;
    }

    /* Badges Estilizados com Glow */
    .badge {
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        display: inline-block;
    }

    .status-pendente { background: #ff9800; color: white; box-shadow: 0 0 10px rgba(255, 152, 0, 0.3); }
    .status-tratativa { background: #00c6ff; color: white; box-shadow: 0 0 10px rgba(0, 198, 255, 0.3); }
    .status-concluido { background: #4caf50; color: white; box-shadow: 0 0 10px rgba(76, 175, 80, 0.3); }

    /* Botão Abrir Chamado (Gradiente padrão) */
    .btn-new {
        background: linear-gradient(90deg, #00c6ff, #0072ff);
        color: white;
        padding: 14px 24px;
        text-decoration: none;
        border-radius: 12px;
        font-weight: bold;
        font-size: 14px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 5px 15px rgba(0, 114, 255, 0.3);
        white-space: nowrap;
    }

    .btn-new:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 25px rgba(0, 198, 255, 0.5);
        filter: brightness(1.1);
    }

    .btn-back {
        display: inline-block;
        margin-top: 35px;
        color: #cfe8ff;
        text-decoration: none;
        font-size: 15px;
        font-weight: 500;
        transition: 0.3s;
    }

    .btn-back:hover {
        color: white;
        transform: translateX(-5px);
    }

    .id-col { color: rgba(255,255,255,0.4); font-family: monospace; font-weight: bold; }

    /* Ajustes Mobile */
    @media (max-width: 650px) {
        .header-flex {
            flex-direction: column;
            text-align: center;
        }
        .btn-new {
            width: 100%;
            box-sizing: border-box;
            text-align: center;
        }
        .glass-card {
            padding: 30px 20px;
        }
    }
</style>

<div class="container">
    <div class="glass-card">
        <div class="header-flex">
            <h2>📋 Meus Chamados</h2>
            <a href="{{ route('os.create') }}" class="btn-new">
                + Abrir Novo Chamado
            </a>
        </div>

        <p class="subtitle">Acompanhe abaixo o status de todos os seus pedidos de suporte.</p>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Categoria</th>
                        <th>Abertura</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ordens as $os)
                        <tr>
                            <td class="id-col">#{{ str_pad($os->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td><strong>{{ $os->titulo }}</strong></td>
                            <td><span style="opacity: 0.8;">{{ $os->categoria }}</span></td>
                            <td>{{ $os->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @if($os->status == 'Pendente')
                                    <span class="badge status-pendente">Pendente</span>
                                @elseif($os->status == 'Em Tratativa')
                                    <span class="badge status-tratativa">Em Tratativa</span>
                                @else
                                    <span class="badge status-concluido">Concluído</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding: 60px; text-align: center; color: rgba(255,255,255,0.3);">
                                <div style="font-size: 40px; margin-bottom: 10px;">📂</div>
                                Você ainda não possui ordens de serviço registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <a href="{{ route('dashboard.usuario') }}" class="btn-back">⬅ Voltar ao Painel</a>
    </div>
</div>

@endsection