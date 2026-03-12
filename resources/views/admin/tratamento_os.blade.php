@extends('layout.main')

@section('title', 'Tratamento de O.S.')

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
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px 20px;
    }

    .glass-card {
        width: 100%;
        max-width: 750px;
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(15px);
        padding: 40px;
        border-radius: 25px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .glass-card h2 {
        margin-top: 0;
        margin-bottom: 20px;
        font-size: 26px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding-bottom: 15px;
    }

    /* Informações do Chamado */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 25px;
        background: rgba(0, 0, 0, 0.2);
        padding: 15px;
        border-radius: 12px;
    }

    .info-item span {
        display: block;
        font-size: 12px;
        color: #cfe8ff;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .info-item strong {
        font-size: 16px;
    }

    /* Estilização dos Grupos de Formulário */
    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        margin-bottom: 8px;
        font-weight: 600;
        color: #00c6ff;
    }

    /* Textarea de Leitura (Problema) */
    .readonly-box {
        background: rgba(255, 255, 255, 0.05) !important;
        color: #bbb !important;
        border: 1px dashed rgba(255, 255, 255, 0.2) !important;
        cursor: not-allowed;
    }

    .form-group input, 
    .form-group select, 
    .form-group textarea {
        width: 100%;
        padding: 14px;
        border-radius: 10px;
        border: none;
        background: rgba(255, 255, 255, 0.95);
        color: #222;
        font-size: 15px;
        outline: none;
        box-sizing: border-box;
        transition: 0.3s;
    }

    .form-group textarea:focus, .form-group select:focus {
        box-shadow: 0 0 0 4px rgba(0, 198, 255, 0.4);
    }

    /* Ações */
    .actions {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-top: 35px;
    }

    .btn-save {
        background: linear-gradient(90deg, #00c6ff, #0072ff);
        color: white;
        padding: 16px 35px;
        border: none;
        border-radius: 12px;
        font-weight: bold;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
        box-shadow: 0 5px 15px rgba(0, 114, 255, 0.3);
    }

    .btn-save:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 25px rgba(0, 198, 255, 0.5);
        filter: brightness(1.1);
    }

    .btn-back {
        color: #cfe8ff;
        text-decoration: none;
        font-size: 14px;
        transition: 0.2s;
    }

    .btn-back:hover {
        color: white;
        text-decoration: underline;
    }

    /* Responsividade */
    @media (max-width: 600px) {
        .info-grid { grid-template-columns: 1fr; }
        .actions { flex-direction: column; width: 100%; }
        .btn-save { width: 100%; }
        .glass-card { padding: 25px 20px; }
    }
</style>

<div class="container">
    <div class="glass-card">
        <h2>🛠️ Tratar Chamado #{{ str_pad($os->id, 4, '0', STR_PAD_LEFT) }}</h2>
        
        <div class="info-grid">
            <div class="info-item">
                <span>Solicitante</span>
                <strong>{{ $os->usuario->name }}</strong>
            </div>
            <div class="info-item">
                <span>Setor</span>
                <strong>{{ $os->setor }}</strong>
            </div>
        </div>

        <form action="{{ route('admin.os.update', $os->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>📝 Descrição do Problema (Relato do Usuário):</label>
                <textarea class="readonly-box" rows="3" readonly>{{ $os->descricao }}</textarea>
            </div>

            <div class="form-group">
                <label>🚦 Alterar Status:</label>
                <select name="status">
                    <option value="Pendente" {{ $os->status == 'Pendente' ? 'selected' : '' }}>🟠 Pendente</option>
                    <option value="Em Tratativa" {{ $os->status == 'Em Tratativa' ? 'selected' : '' }}>🔵 Em Tratativa</option>
                    <option value="Concluído" {{ $os->status == 'Concluído' ? 'selected' : '' }}>🟢 Concluído</option>
                </select>
            </div>

            <div class="form-group">
                <label>👨‍💻 Resolução / Observações Técnicas:</label>
                <textarea name="descricao" rows="5" placeholder="Descreva o que foi feito para resolver este chamado..." required>{{ $os->descricao }}</textarea>
            </div>

            <div class="actions">
                <button type="submit" class="btn-save">Salvar Alterações</button>
                <a href="{{ route('admin.os.index') }}" class="btn-back">⬅ Voltar para a Lista</a>
            </div>
        </form>
    </div>
</div>

@endsection