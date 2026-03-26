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
    align-items: center;
    padding: 60px 20px;
}

.welcome-header {
    text-align: center;
    margin-bottom: 60px;
}

.welcome-header h2 {
    font-size: 36px;
    margin-bottom: 10px;
}

.welcome-header p {
    color: #cfe8ff;
    font-size: 18px;
}

/* CARDS */
.action-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 40px;
    width: 100%;
    max-width: 900px;
}

.action-card {
    background: rgba(255,255,255,0.07);
    backdrop-filter: blur(15px);
    padding: 60px 40px;
    border-radius: 25px;
    text-align: center;
    transition: 0.4s;
    cursor: pointer;
}

.action-card:hover {
    transform: translateY(-15px);
    background: rgba(255,255,255,0.12);
}

.card-icon {
    font-size: 50px;
    margin-bottom: 20px;
}

.action-card h3 {
    font-size: 26px;
}

.action-card p {
    color: #cfe8ff;
}

.btn-action {
    display: block;
    margin-top: 25px;
    padding: 15px;
    border-radius: 10px;
    background: linear-gradient(90deg,#00c6ff,#0072ff);
    color: white;
    text-decoration: none;
}

/* NOTIFICAÇÕES */
.notifications-box {
    margin-top: 60px;
    width: 100%;
    max-width: 900px;
    background: rgba(255,255,255,0.05);
    padding: 25px;
    border-radius: 20px;
}

.notifications-box h3 {
    margin-bottom: 20px;
}

.notification-item {
    background: rgba(255,255,255,0.08);
    padding: 15px;
    border-radius: 12px;
    margin-bottom: 12px;
    border-left: 4px solid #00c6ff;
    transition: 0.3s;
}

.notification-item:hover {
    transform: translateX(5px);
    background: rgba(255,255,255,0.12);
}

.notification-time {
    display: block;
    font-size: 12px;
    color: #cfe8ff;
    margin-top: 5px;
}

.empty {
    opacity: 0.6;
}
</style>

<div class="dashboard-container">

    <!-- TOPO -->
    <div class="welcome-header">
        <h2>Olá, {{ Auth::user()->name }}! 👋</h2>
        <p>Selecione uma das opções abaixo para gerenciar seu suporte.</p>
    </div>

    <!-- CARDS -->
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

    <!-- 🔔 NOTIFICAÇÕES -->
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
            <p class="empty">Nenhuma notificação</p>
        @endforelse
    </div>

</div>

@endsection