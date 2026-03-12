@extends('layout.main')

@section('title', 'Editar Usuário')

@section('content')

<style>
    body {
        margin: 0;
        background: linear-gradient(135deg,#0f2027,#203a43,#2c5364);
        font-family: 'Segoe UI', sans-serif;
        color: white;
        min-height: 100vh;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 60px 20px;
    }

    .glass-card {
        width: 100%;
        max-width: 600px;
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

    .glass-card h2 { margin-top: 0; margin-bottom: 10px; font-size: 26px; }
    
    .subtitle { color: #cfe8ff; font-size: 14px; margin-bottom: 30px; opacity: 0.8; }

    .form-group { margin-bottom: 20px; }

    .form-group label {
        display: block;
        font-size: 13px;
        margin-bottom: 8px;
        font-weight: 600;
        color: #00c6ff;
        text-transform: uppercase;
    }

    .form-group input, .form-group select {
        width: 100%;
        padding: 15px;
        border-radius: 10px;
        border: none;
        background: rgba(255, 255, 255, 0.95);
        color: #1a1a1a;
        font-size: 15px;
        outline: none;
        transition: 0.3s;
    }

    .form-group input:focus, .form-group select:focus {
        box-shadow: 0 0 0 4px rgba(0, 198, 255, 0.4);
        transform: translateY(-2px);
    }

    .actions { display: flex; align-items: center; gap: 20px; margin-top: 35px; }

    .btn-submit {
        flex: 2;
        background: linear-gradient(90deg, #ff9800, #f57c00);
        color: white;
        padding: 16px;
        border: none;
        border-radius: 12px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.4s;
    }

    .btn-submit:hover { transform: scale(1.05); box-shadow: 0 8px 20px rgba(255, 152, 0, 0.4); }

    .btn-back { flex: 1; color: #cfe8ff; text-decoration: none; text-align: center; font-size: 14px; }
    
    .helper-text { font-size: 11px; color: #aaa; margin-top: 5px; display: block; }
</style>

<div class="container">
    <div class="glass-card">
        <h2>✏️ Editar Usuário</h2>
        <p class="subtitle">Alterando dados de: <strong>{{ $user->name }}</strong></p>

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nome Completo</label>
                <input type="text" name="name" value="{{ $user->name }}" required>
            </div>

            <div class="form-group">
                <label>E-mail de Acesso</label>
                <input type="email" name="email" value="{{ $user->email }}" required>
            </div>

            <div class="form-group">
                <label>Nova Senha</label>
                <input type="password" name="password" placeholder="Deixe em branco para não alterar">
                <span class="helper-text">Preencha apenas se desejar resetar a senha do usuário.</span>
            </div>

            <div class="form-group">
                <label>Perfil de Acesso</label>
                <select name="perfil" required>
                    <option value="comum" {{ $user->perfil == 'comum' ? 'selected' : '' }}>👤 Usuário Padrão</option>
                    <option value="admin" {{ $user->perfil == 'admin' ? 'selected' : '' }}>🛠️ Administrador</option>
                </select>
            </div>

            <div class="actions">
                <button type="submit" class="btn-submit">Salvar Alterações</button>
                <a href="{{ route('users.index') }}" class="btn-back">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@endsection