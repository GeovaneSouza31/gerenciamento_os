@extends('layout.main')

@section('title', 'Abrir Chamado')

@section('content')
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2>Abertura de Ordem de Serviço</h2>
        <p>Preencha os detalhes do problema para que o suporte possa te ajudar.</p>

        <form action="{{ route('os.store') }}" method="POST">
            @csrf

            {{-- Título --}}
            <div style="margin-bottom: 15px;">
                <label>Título do Problema:</label><br>
                <input type="text" name="titulo" required style="width: 100%;" placeholder="Ex: Monitor não liga">
            </div>

            {{-- Setor --}}
            <div style="margin-bottom: 15px;">
                <label>Seu Setor:</label><br>
                <input type="text" name="setor" required style="width: 100%;" placeholder="Ex: Financeiro / RH">
            </div>

            {{-- Categoria --}}
            <div style="margin-bottom: 15px;">
                <label>Categoria:</label><br>
                <select name="categoria" required style="width: 100%;">
                    <option value="">Selecione...</option>
                    <option value="Hardware">Hardware (Peças, periféricos)</option>
                    <option value="Software">Software (Sistemas, programas)</option>
                    <option value="Rede">Rede (Internet, cabos)</option>
                    <option value="Outros">Outros</option>
                </select>
            </div>

            {{-- Equipamento --}}
            <div style="margin-bottom: 15px;">
                <label>Equipamento (Opcional):</label><br>
                <input type="text" name="equipamento" style="width: 100%;" placeholder="Ex: Notebook Dell 01">
            </div>

            {{-- Descrição --}}
            <div style="margin-bottom: 15px;">
                <label>Descrição Detalhada:</label><br>
                <textarea name="descricao" rows="5" required style="width: 100%;" placeholder="Descreva o que está acontecendo..."></textarea>
            </div>

            <button type="submit" style="background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
                Enviar Solicitação
            </button>
            
            <a href="{{ route('dashboard.usuario') }}" style="margin-left: 10px; color: #666;">Cancelar</a>
        </form>
    </div>
@endsection