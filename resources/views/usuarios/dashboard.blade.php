@extends('layout.main')

@section('title', 'Meu Painel')

@section('content')

<style>
    body {
        margin: 0;
        background: linear-gradient(135deg,#0f2027,#203a43,#2c5364);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: white;
        min-height: 100vh;
        overflow-x: hidden;
    }

    .dashboard-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 60px 20px;
        min-height: 80vh;
    }

    .welcome-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .welcome-header h2 {
        font-size: 36px;
        margin-bottom: 10px;
        text-shadow: 2px 2px 10px rgba(0,0,0,0.3);
    }

    .welcome-header p {
        color: #cfe8ff;
        font-size: 18px;
        opacity: 0.9;
    }

    /* Grid de Cards Maiores */
    .action-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 40px;
        width: 100%;
        max-width: 900px; /* Limita a largura para os cards não ficarem esticados demais */
    }

    .action-card {
        background: rgba(255, 255, 255, 0.07);
        backdrop-filter: blur(15px);
        padding: 60px 40px; /* Aumentado o respiro interno */
        border-radius: 25px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        text-align: center;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); /* Animação mais suave e elástica */
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        cursor: pointer;
    }

    /* Efeito de Hover Ultra Responsivo */
    .action-card:hover {
        transform: translateY(-20px) scale(1.02);
        background: rgba(255, 255, 255, 0.12);
        border-color: #00c6ff;
        box-shadow: 0 25px 50px rgba(0, 198, 255, 0.3);
    }

    .action-card h3 {
        margin-bottom: 20px;
        font-size: 28px;
        letter-spacing: 1px;
    }

    .action-card p {
        font-size: 16px;
        color: #cfe8ff;
        margin-bottom: 35px;
        line-height: 1.6;
    }

    /* Estilo dos Botões Grandes */
    .btn-action {
        display: block;
        padding: 18px 0;
        border-radius: 12px;
        text-decoration: none;
        font-weight: bold;
        font-size: 18px;
        background: linear-gradient(90deg, #00c6ff, #0072ff);
        color: white;
        transition: 0.3s;
        box-shadow: 0 4px 15px rgba(0, 114, 255, 0.3);
    }

    .btn-action:hover {
        filter: brightness(1.2);
        letter-spacing: 1px;
    }

    /* Ícones grandes nos cards */
    .card-icon {
        font-size: 50px;
        margin-bottom: 20px;
        display: block;
    }
</style>

<div class="dashboard-container">
    <div class="welcome-header">
        <h2>Olá, {{ Auth::user()->name }}! 👋</h2>
        <p>Selecione uma das opções abaixo para gerenciar seu suporte.</p>
    </div>

    <div class="action-grid">
        <div class="action-card" onclick="location.href='{{ route('os.create') }}'">
            <div>
                <span class="card-icon">🚀</span>
                <h3>Nova Solicitação</h3>
                <p>Relate um novo problema técnico ou solicite um serviço agora mesmo.</p>
            </div>
            <a href="{{ route('os.create') }}" class="btn-action">
                Abrir Chamado
            </a>
        </div>

        <div class="action-card" onclick="location.href='{{ route('os.index') }}'">
            <div>
                <span class="card-icon">📂</span>
                <h3>Meus Chamados</h3>
                <p>Veja o andamento, histórico e atualizações das suas solicitações.</p>
            </div>
            <a href="{{ route('os.index') }}" class="btn-action">
                Ver Histórico
            </a>
        </div>
    </div>
</div>

@endsection