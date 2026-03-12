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
        text-align: left;
    }

    .dashboard-header h2 {
        font-size: 32px;
        text-shadow: 2px 2px 10px rgba(0,0,0,0.4);
    }

    /* Grid de Estatísticas Ampliado */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-bottom: 60px;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.07);
        backdrop-filter: blur(15px);
        padding: 45px 35px; /* Box maior */
        border-radius: 25px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
    }

    /* Efeito de Hover "Pop" */
    .stat-card:hover {
        transform: translateY(-15px) scale(1.03);
        background: rgba(255, 255, 255, 0.12);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
    }

    .stat-card h4 {
        margin: 0;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: #cfe8ff;
        opacity: 0.8;
    }

    .stat-card .value {
        font-size: 52px; 
        font-weight: 800;
        margin: 20px 0 0 0;
        display: block;
        background: linear-gradient(to bottom, #ffffff, #cfe8ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Indicadores Coloridos com Glow */
    .border-blue { border-left: 8px solid #00c6ff; }
    .stat-card.border-blue:hover { border-color: #00c6ff; box-shadow: 0 15px 35px rgba(0, 198, 255, 0.2); }

    .border-orange { border-left: 8px solid #ff9800; }
    .stat-card.border-orange:hover { border-color: #ff9800; box-shadow: 0 15px 35px rgba(255, 152, 0, 0.2); }

    .border-green { border-left: 8px solid #4caf50; }
    .stat-card.border-green:hover { border-color: #4caf50; box-shadow: 0 15px 35px rgba(76, 175, 80, 0.2); }

    /* Seção de Ações Rápidas */
    .actions-box {
        background: rgba(255, 255, 255, 0.05);
        padding: 40px;
        border-radius: 25px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(5px);
    }

    .actions-box h3 {
        margin-top: 0;
        margin-bottom: 30px;
        font-size: 24px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-group {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }

    .btn-dash {
        padding: 60px;
        border-radius: 15px;
        text-decoration: none;
        font-weight: bold;
        font-size: 18px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        transition: all 0.3s ease;
        background: linear-gradient(90deg, #00c6ff, #0072ff);
        box-shadow: 0 5px 15px rgba(0, 114, 255, 0.3);
    }

    .btn-dash:hover {
        transform: scale(1.05);
        filter: brightness(1.2);
        box-shadow: 0 10px 25px rgba(0, 198, 255, 0.5);
        letter-spacing: 1px;
    }

    /* Responsividade Mobile */
    @media (max-width: 768px) {
        .dashboard-wrapper { padding: 30px 15px; }
        .stat-card { padding: 30px 20px; }
        .stat-card .value { font-size: 42px; }
    }
</style>

<div class="dashboard-wrapper">
    <div class="dashboard-header">
        <h2>Painel de Controle - Administrador 🛠️</h2>
    </div>

    <div class="stats-container">
        <div class="stat-card border-blue">
            <h4>📈 Total de OS</h4>
            <span class="value">{{ $stats['total'] }}</span>
        </div>

        <div class="stat-card border-orange">
            <h4>⏳ Pendentes</h4>
            <span class="value">{{ $stats['pendentes'] }}</span>
        </div>

        <div class="stat-card border-green">
            <h4>✅ Concluídas</h4>
            <span class="value">{{ $stats['concluidas'] }}</span>
        </div>
    </div>

    <div class="actions-box">
        <h3>⚡ Ações Rápidas</h3>
        <div class="btn-group">
            <a href="{{ route('admin.os.index') }}" class="btn-dash">
                📋 Gerenciar Todas as OS
            </a>
            <a href="{{ route('users.index') }}" class="btn-dash">
                👥 Gestão de Usuários
            </a>
        </div>
    </div>
</div>

@endsection