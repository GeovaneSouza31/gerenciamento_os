@extends('layout.main')

@section('title', 'Painel Administrativo')

@section('content')
    <div style="padding: 20px;">
        <h2>Painel de Controle - Administrador 🛠️</h2>
        
        <div style="display: flex; gap: 15px; margin-top: 20px;">
            <div style="flex: 1; background: #e3f2fd; padding: 20px; border-radius: 8px; border-left: 5px solid #2196f3;">
                <h4 style="margin: 0;">Total de OS</h4>
                <p style="font-size: 24px; font-weight: bold; margin: 10px 0;">{{ $stats['total'] }}</p>
            </div>

            <div style="flex: 1; background: #fff3e0; padding: 20px; border-radius: 8px; border-left: 5px solid #ff9800;">
                <h4 style="margin: 0;">Pendentes</h4>
                <p style="font-size: 24px; font-weight: bold; margin: 10px 0;">{{ $stats['pendentes'] }}</p>
            </div>

            <div style="flex: 1; background: #e8f5e9; padding: 20px; border-radius: 8px; border-left: 5px solid #4caf50;">
                <h4 style="margin: 0;">Concluídas</h4>
                <p style="font-size: 24px; font-weight: bold; margin: 10px 0;">{{ $stats['concluidas'] }}</p>
            </div>
        </div>

        <div style="margin-top: 40px;">
            <h3>Ações Rápidas</h3>
            <a href="{{ route('admin.os.index') }}" style="display: inline-block; padding: 12px 25px; background: #333; color: #fff; text-decoration: none; border-radius: 5px;">
                Gerenciar Todas as Ordens de Serviço
            </a>
            <a href="{{ route('users.index') }}" style="display: inline-block; padding: 12px 25px; border: 1px solid #333; color: #333; text-decoration: none; border-radius: 5px; margin-left: 10px;">
                Gestão de Usuários
            </a>
        </div>
    </div>
@endsection