@extends('layout.main')

@section('title', 'Tratamento de O.S.')

@section('content')
    <div style="padding: 20px; max-width: 700px;">
        <h2>Tratar Chamado #{{ $os->id }}</h2>
        <p><strong>Solicitante:</strong> {{ $os->usuario->name }}</p>
        <p><strong>Setor:</strong> {{ $os->setor }}</p>

        <form action="{{ route('admin.os.update', $os->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 15px;">
                <label>Descrição do Problema:</label><br>
                <textarea style="width: 100%; background: #eee;" rows="4" readonly>{{ $os->descricao }}</textarea>
            </div>

            <div style="margin-bottom: 15px;">
                <label>Status Atual:</label><br>
                <select name="status" style="width: 100%; padding: 5px;">
                    <option value="Pendente" {{ $os->status == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                    <option value="Em Atendimento" {{ $os->status == 'Em Tratativa' ? 'selected' : '' }}>Em Tratativa</option>
                    <option value="Concluído" {{ $os->status == 'Concluído' ? 'selected' : '' }}>Concluído</option>
                </select>
            </div>

            <div style="margin-bottom: 15px;">
                <label>Resolução / Observações Técnicas:</label><br>
                <textarea name="descricao" style="width: 100%;" rows="4" placeholder="O que foi feito para resolver?">{{ $os->descricao }}</textarea>
            </div>

            <button type="submit" style="background: #28a745; color: white; padding: 10px 20px; border: none; cursor: pointer;">
                Salvar Alterações
            </button>
            <a href="{{ route('admin.os.index') }}" style="margin-left: 10px;">Voltar</a>
        </form>
    </div>
@endsection