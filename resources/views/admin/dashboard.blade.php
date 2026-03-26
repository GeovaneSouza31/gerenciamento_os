@extends('layout.main')

@section('title', 'Painel Administrativo')

@section('content')

<style>
    body {
        margin: 0;
        background: linear-gradient(135deg,#0f2027,#203a43,#2c5364);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: white;
        min-height: 100vh;
    }

    .dashboard-wrapper {
        padding: 60px 20px;
        max-width: 1300px;
        margin: 0 auto;
        animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .dashboard-header {
        margin-bottom: 50px;
    }

    .dashboard-header h2 {
        font-size: 32px;
    }

    /* Container dos cards */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        margin-bottom: 40px;
    }

    /* Cards iguais */
    .stat-card {
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(15px);
        padding: 40px;
        border-radius: 25px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-card h4 {
        margin: 0;
        font-size: 14px;
        color: #cfe8ff;
    }

    .stat-card .value {
        font-size: 42px;
        font-weight: bold;
        margin-top: 10px;
    }

    /* Grupo de botões */
    .btn-group {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 60px;
    }

    .btn-dash {
        display: block;
        padding: 25px;
        border-radius: 10px;
        text-align: center;
        text-decoration: none;
        color: white;
        background: linear-gradient(90deg,#00c6ff,#0072ff);
        font-weight: 600;
        font-size: 18px;
        box-shadow: 0 3px 8px rgba(0, 114, 255, 0.6);
        transition: background 0.3s ease;
    }

    .btn-dash:hover {
        background: linear-gradient(90deg,#0072ff,#00c6ff);
    }

    .actions-box, .notifications-box {
        background: rgba(255,255,255,0.05);
        padding: 30px;
        border-radius: 20px;
        margin-bottom: 40px;
    }

    /* NOTIFICAÇÕES BONITAS */
    .notification-item {
        background: rgba(255,255,255,0.08);
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 10px;
        border-left: 4px solid #00c6ff;
    }

    .notification-time {
        font-size: 12px;
        color: #aaa;
        display: block;
        margin-top: 5px;
    }

    /* Responsividade geral */
    @media (max-width: 600px) {
        .stat-card {
            padding: 25px;
        }
        .btn-dash {
            padding: 20px;
            font-size: 16px;
        }
    }
</style>

<div class="dashboard-wrapper">

    <div class="dashboard-header">
        <h2>Painel de Controle - Administrador 🛠️</h2>
    </div>

    <div class="stats-container">
        <div class="stat-card">
            <h4>Total de OS</h4>
            <span class="value">{{ $stats['total'] }}</span>
        </div>
        <div class="stat-card">
            <h4>Pendentes</h4>
            <span class="value">{{ $stats['pendentes'] }}</span>
        </div>
        <div class="stat-card">
            <h4>Concluídas</h4>
            <span class="value">{{ $stats['concluidas'] }}</span>
        </div>
    </div>

    <div class="btn-group">
        <a href="{{ route('relatorios.pdf') }}" class="btn-dash">📄 Exportar PDF</a>
        <a href="{{ route('relatorios.index') }}" class="btn-dash">📊 Ver Relatórios</a>
        <a href="{{ route('admin.os.index') }}" class="btn-dash">📋 Gerenciar OS</a>
        <a href="{{ route('users.index') }}" class="btn-dash">👥 Usuários</a>
    </div>

    <div class="notifications-box">
        <h3>🔔 Notificações</h3>

        @forelse($notificacoes as $n)
            <div class="notification-item">
                {{ $n->mensagem }}

                <span class="notification-time">
                    {{ $n->created_at->diffForHumans() }}
                </span>
            </div>
        @empty
            <p>Nenhuma notificação</p>
        @endforelse
    </div>

</div>

@endsection