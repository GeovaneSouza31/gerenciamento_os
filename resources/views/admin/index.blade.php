@extends('layout.main')

@section('title', 'Gerenciar Chamados')

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
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Card Principal com Animação */
    .glass-card {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(15px);
        padding: 35px;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .header-section {
        margin-bottom: 30px;
    }

    .header-section h2 {
        margin: 0;
        font-size: 28px;
        letter-spacing: 1px;
    }

    .subtitle {
        color: #cfe8ff;
        font-size: 14px;
        opacity: 0.8;
    }

    /* Tabela Responsiva */
    .table-responsive {
        width: 100%;
        overflow-x: auto;
        border-radius: 12px;
        background: rgba(0, 0, 0, 0.15);
        margin-top: 20px;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 850px;
    }

    .custom-table th {
        padding: 18px 15px;
        background: rgba(255, 255, 255, 0.05);
        text-align: left;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #00c6ff;
    }

    .custom-table td {
        padding: 18px 15px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        font-size: 14px;
        transition: 0.3s;
    }

    /* Hover na Linha */
    .custom-table tbody tr {
        transition: 0.3s;
    }

    .custom-table tbody tr:hover {
        background: rgba(255, 255, 255, 0.05);
        box-shadow: inset 4px 0 0 #00c6ff;
    }

    /* Badges de Status */
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

    /* Botão de Ação */
    .btn-view {
        background: linear-gradient(90deg, #00c6ff, #0072ff);
        color: white;
        padding: 8px 16px;
        text-decoration: none;
        border-radius: 6px;
        font-size: 12px;
        font-weight: bold;
        transition: 0.3s;
        display: inline-block;
    }

    .btn-view:hover {
        transform: scale(1.1);
        filter: brightness(1.2);
        box-shadow: 0 0 15px rgba(0, 198, 255, 0.5);
    }

    .btn-back {
        display: inline-block;
        margin-top: 30px;
        color: #cfe8ff;
        text-decoration: none;
        font-size: 14px;
        transition: 0.3s;
    }

    .btn-back:hover {
        color: white;
        transform: translateX(-5px);
    }

    .id-col { color: rgba(255,255,255,0.4); font-family: monospace; font-weight: bold; }
    .user-col { font-weight: 600; color: #fff; }

    /* Scrollbar */
    .table-responsive::-webkit-scrollbar { height: 6px; }
    .table-responsive::-webkit-scrollbar-thumb { background: rgba(0, 198, 255, 0.3); border-radius: 10px; }
</style>

<div class="container">
    <div class="glass-card">
        <div class="header-section">
            <h2>Gestão de Ordens de Serviço 🛠️</h2>
            <p class="subtitle">Abaixo estão todos os chamados registrados no sistema para atendimento técnico.</p>
        </div>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuário</th>
                        <th>Título</th>
                        <th>Setor</th>
                        <th>Data</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ordens as $os)
                        <tr>
                            <td class="id-col">#{{ str_pad($os->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td class="user-col">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div style="width: 30px; height: 30px; background: rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px;">
                                        {{ strtoupper(substr($os->usuario->name ?? 'S', 0, 1)) }}
                                    </div>
                                    {{ $os->usuario->name ?? 'Sistema' }}
                                </div>
                            </td>
                            <td><strong>{{ $os->titulo }}</strong></td>
                            <td>{{ $os->setor }}</td>
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
                            <td>
                                <a href="{{ route('admin.os.show', $os->id) }}" class="btn-view">
                                    Visualizar
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="padding: 60px; text-align: center; color: rgba(255,255,255,0.3);">
                                <div style="font-size: 40px; margin-bottom: 10px;">🔍</div>
                                Nenhuma ordem de serviço encontrada.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <a href="{{ route('dashboard.admin') }}" class="btn-back">⬅ Voltar ao Painel</a>
    </div>
</div>

@endsection