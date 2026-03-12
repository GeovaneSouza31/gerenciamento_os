@extends('layout.main')

@section('title', 'Recuperar Senha')

@section('content')

<style>
body {
    margin: 0;
    background: linear-gradient(135deg,#0f2027,#203a43,#2c5364);
    font-family: Arial, Helvetica, sans-serif;
    height: 100vh;
}

.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 90vh;
}

.login-box {
    width: 380px;
    padding: 40px;
    border-radius: 12px;
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(10px);
    box-shadow: 0 0 25px rgba(0,0,0,0.4);
    color: white;
}

.login-box h2 {
    text-align: center;
    margin-bottom: 20px;
}

.login-box p {
    text-align: center;
    font-size: 14px;
    color: #cfe8ff;
    margin-bottom: 30px;
    line-height: 1.5;
}

.input-group {
    margin-bottom: 20px;
}

.input-group label {
    font-size: 14px;
}

.input-group input {
    width: 100%;
    padding: 14px;
    border-radius: 6px;
    border: none;
    margin-top: 6px;
    outline: none;
}

button {
    width: 100%;
    padding: 16px;
    border: none;
    border-radius: 8px;
    background: linear-gradient(90deg,#00c6ff,#0072ff);
    color: white;
    font-weight: bold;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
    display: block;
    margin: 30px auto 0 auto;
}

button:hover {
    transform: scale(1.05);
    box-shadow: 0 0 12px #00c6ff;
}

.forgot {
    text-align: center;
    margin-top: 20px;
}

.forgot a {
    color: #cfe8ff;
    text-decoration: none;
    font-size: 14px;
}

.forgot a:hover {
    text-decoration: underline;
}
</style>

<div class="login-container">
    <div class="login-box">
        <h2>🔑 Recuperar Acesso</h2>
        
        <p>Informe seu e-mail cadastrado. Um chamado de suporte será aberto para o administrador resetar sua senha.</p>

        <form action="{{ route('password.request') }}" method="POST">
            @csrf

            <div class="input-group">
                <label>E-mail Cadastrado</label>
                <input type="email" name="email" placeholder="seu@email.com" required>
            </div>

            <button type="submit">Solicitar Nova Senha</button>

            <div class="forgot">
                <a href="{{ route('login') }}">⬅ Voltar para o Login</a>
            </div>
        </form>
    </div>
</div>

@endsection