@extends('layout.main')

@section('title', 'Meus Chamados')

@section('content')
    <div style="padding: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2>Histórico de Solicitações</h2>
            <a href="{{ route('os.create') }}" style="background: #007bff; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px;">
                + Abrir Novo Chamado
            </a>
        </div>

        <p>Acompanhe abaixo o status de todos os seus pedidos de suporte.</p>

        <table border="1" style="width: 100%; margin-top: 20px; border-collapse: collapse; text-align: left;">
            <thead style="background: #f4f4f4;">
                <tr>
                    <th style="padding: 10px;">ID</th>
                    <th style="padding: 10px;">Título</th>
                    <th style="padding: 10px;">Categoria</th>
                    <th style="padding: 10px;">Data de Abertura</th>
                    <th style="padding: 10px;">Status</th>
                </tr>
            </thead>
            <tbody>
                {{-- Aqui o @forelse vai brilhar quando ligarmos o banco --}}
                @forelse($ordens as $os)
                    <tr>
                        <td style="padding: 10px;">#{{ $os->id }}</td>
                        <td style="padding: 10px;">{{ $os->titulo }}</td>
                        <td style="padding: 10px;">{{ $os->categoria }}</td>
                        <td style="padding: 10px;">{{ $os->created_at->format('d/m/Y H:i') }}</td>
                        <td style="padding: 10px;">
                            <strong>{{ $os->status }}</strong>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding: 20px; text-align: center;">
                            Você ainda não abriu nenhuma ordem de serviço.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            <a href="{{ route('dashboard.usuario') }}">⬅ Voltar ao Painel</a>
        </div>
    </div>
@endsection