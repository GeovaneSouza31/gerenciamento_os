@extends('layout.main')

@section('title', 'Recuperar Senha')

@section('content')
    <div style="max-width: 400px; margin: 0 auto;">
        <h2>Recuperar Acesso</h2>
        <p>Informe seu e-mail cadastrado. Um chamado de suporte será aberto automaticamente para o administrador resetar sua senha.</p>

        <form action="{{ route('password.request') }}" method="POST">
            @csrf
            
            <div style="margin-bottom: 15px;">
                <label for="email">E-mail Cadastrado:</label><br>
                <input type="email" name="email" id="email" required style="width: 100%;" placeholder="seu@email.com">
            </div>

            <button type="submit" style="width: 100%;">Solicitar Nova Senha</button>
        </form>

        <p style="margin-top: 15px;">
            <a href="{{ route('login') }}">Voltar para o Login</a>
        </p>
    </div>
@endsection