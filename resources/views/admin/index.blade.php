@extends('layout.main')

@section('title', 'Gerenciar Chamados')

@section('content')
    <div>
        <h2>Gestão de Ordens de Serviço</h2>
        <p>Abaixo estão todos os chamados registrados no sistema.</p>

        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuário</th>
                    <th>Título</th>
                    <th>Setor</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ordens as $os)
                    <tr>
                        <td>#{{ $os->id }}</td>
                        <td>{{ $os->usuario->name ?? 'Sistema' }}</td>
                        <td>{{ $os->titulo }}</td>
                        <td>{{ $os->setor }}</td>
                        <td>{{ $os->created_at->format('d/m/Y H:i') }}</td>
                        <td><strong>{{ $os->status }}</strong></td>
                        <td>
                            <a href="{{ route('admin.os.show', $os->id) }}">Visualizar</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Nenhuma ordem de serviço encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            <a href="{{ route('dashboard.admin') }}">⬅ Voltar ao Painel</a>
        </div>
    </div>
@endsection