@extends('layout.main') {{-- Busca em layouts/main.blade.php --}}

@section('title', 'Acesso ao Sistema')

@section('content')
    <h2>Login</h2>
    <form action="/login" method="POST">
        @csrf
        <div>
            <label>E-mail:</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Senha:</label>
            <input type="password" name="password" required>
        </div>
        
        <button type="submit">Entrar</button>

        {{-- Implementação do link para esqueci minha senha --}}
        <div style="margin-top: 15px;">
            <a href="{{ route('password.request') }}">Esqueci minha senha</a>
        </div>
    </form>
@endsection