@extends('layout.main')

@section('title', 'Meu Painel')

@section('content')
    <div style="padding: 20px;">
        <h2>Olá, {{ Auth::user()->name }}! 👋</h2>
        <p>O que você deseja fazer hoje?</p>

        <div style="display: flex; gap: 20px; margin-top: 30px;">
            
            <div style="border: 1px solid #ddd; padding: 20px; border-radius: 8px; width: 250px; text-align: center;">
                <h3>Nova Solicitação</h3>
                <p>Está com algum problema técnico?</p>
                <a href="{{ route('os.create') }}" style="display: inline-block; padding: 10px 20px; background: #007bff; color: #fff; text-decoration: none; border-radius: 5px;">
                    Abrir Chamado
                </a>
            </div>

            <div style="border: 1px solid #ddd; padding: 20px; border-radius: 8px; width: 250px; text-align: center;">
                <h3>Meus Chamados</h3>
                <p>Acompanhe o status dos seus pedidos.</p>
                <a href="{{ route('os.index') }}" style="display: inline-block; padding: 10px 20px; background: #6c757d; color: #fff; text-decoration: none; border-radius: 5px;">
                    Ver Histórico
                </a>
            </div>

        </div>

        <hr style="margin: 40px 0;">

        <div style="background: #f9f9f9; padding: 15px; border-radius: 5px;">
            <h4>Resumo das minhas solicitações:</h4>
            <ul>
                <li>Total de pedidos: <strong>0</strong></li>
                <li>Em atendimento: <strong>0</strong></li>
            </ul>
        </div>
    </div>
@endsection