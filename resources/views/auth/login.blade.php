@extends('layout.main') {{-- Busca em layouts/main.blade.php --}}

@section('title', 'Acesso ao Sistema')

@section('content')

<div style="display:flex; justify-content:center; align-items:center; height:70vh;">

    <div style="width:350px;">

        <h2 style="text-align:center;">Login</h2>

        <form action="/login" method="POST">
            @csrf

            <div style="margin-bottom:10px;">
                <label>E-mail:</label>
                <input type="email" name="email" required style="width:100%;">
            </div>

            <div style="margin-bottom:10px;">
                <label>Senha:</label>
                <input type="password" name="password" required style="width:100%;">
            </div>
            
            <button type="submit" style="width:100%;">Entrar</button>

            {{-- Implementação do link para esqueci minha senha --}}
            <div style="margin-top: 15px; text-align:center;">
                <a href="{{ route('password.request') }}">Esqueci minha senha</a>
            </div>

        </form>

    </div>

</div>

@endsection