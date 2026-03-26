@extends('layout.main')

@section('title', 'Relatórios')

@section('content')

<style>
body {
    margin: 0;
    background: linear-gradient(135deg,#0f2027,#203a43,#2c5364);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: white;
    min-height: 100vh;
}

/* WRAPPER */
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
    margin-bottom: 40px;
}

.dashboard-header h2 {
    font-size: 30px;
}

/* CARDS */
.stats-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
    margin-bottom: 50px;
}

.stat-card {
    background: rgba(255, 255, 255, 0.07);
    backdrop-filter: blur(15px);
    padding: 35px;
    border-radius: 20px;
    transition: 0.3s;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
}

.stat-card h4 {
    margin: 0;
    font-size: 14px;
    color: #cfe8ff;
}

.stat-card .value {
    font-size: 40px;
    font-weight: bold;
    margin-top: 10px;
}

/* TABELA (SEM FUNDO BRANCO 🔥) */
.table-box {
    background: rgba(255,255,255,0.05);
    padding: 25px;
    border-radius: 20px;
    backdrop-filter: blur(15px);
}

.table {
    width: 100%;
    border-collapse: collapse;
    background: transparent;
}

.table thead {
    background: rgba(255,255,255,0.06);
}

.table th {
    text-align: left;
    padding: 15px;
    font-size: 13px;
    color: #cfe8ff;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.table td {
    padding: 15px;
    color: #ffffff;
    border-bottom: 1px solid rgba(255,255,255,0.08);
}

.table tr {
    background: transparent;
}

.table tbody tr:hover {
    background: rgba(255,255,255,0.05);
}

/* força remover qualquer branco herdado */
table, thead, tbody, tr, td, th {
    background: transparent !important;
}

/* BADGES */
.badge {
    padding: 5px 12px;
    border-radius: 10px;
    font-size: 12px;
    font-weight: 500;
}

.badge.concluida {
    background: rgba(34,197,94,0.2);
    color: #4ade80;
}

.badge.pendente {
    background: rgba(251,191,36,0.2);
    color: #fde047;
}

</style>

<div class="dashboard-wrapper">

    <div class="dashboard-header">
        <h2>📊 Relatórios de OS</h2>
    </div>

    <!-- CARDS -->
    <div class="stats-container">

        <div class="stat-card">
            <h4>Total</h4>
            <div class="value" id="total">0</div>
        </div>

        <div class="stat-card">
            <h4>Concluídas</h4>
            <div class="value" id="concluidas">0</div>
        </div>

        <div class="stat-card">
            <h4>Pendentes</h4>
            <div class="value" id="pendentes">0</div>
        </div>

    </div>

    <!-- TABELA -->
    <div class="table-box">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Status</th>
                    <th>Usuário</th>
                </tr>
            </thead>
            <tbody id="tabela"></tbody>
        </table>
    </div>

</div>

<script>
fetch('/api/relatorios/concluidas')
.then(res => res.json())
.then(data => {

    document.getElementById('total').innerText = data.total;
    document.getElementById('concluidas').innerText = data.total;

    let tabela = document.getElementById('tabela');

    data.dados.forEach(os => {

        let statusClass = os.status === 'Concluída' ? 'concluida' : 'pendente';

        tabela.innerHTML += `
            <tr>
                <td>${os.id}</td>
                <td>${os.titulo}</td>
                <td><span class="badge ${statusClass}">${os.status}</span></td>
                <td>${os.usuario.name}</td>
            </tr>
        `;
    });

});

// pendentes
fetch('/api/relatorios/por-status')
.then(res => res.json())
.then(data => {
    document.getElementById('pendentes').innerText = data.Pendente;
});
</script>

@endsection