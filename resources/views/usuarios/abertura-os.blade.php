@extends('layout.main')

@section('title', 'Abrir Chamado')

@section('content')

<style>
    body {
        margin: 0;
        background: linear-gradient(135deg,#0f2027,#203a43,#2c5364);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: white;
        min-height: 100vh;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 60px 20px;
    }

    /* Card com animação de entrada suave */
    .glass-card {
        width: 100%;
        max-width: 700px;
        background: rgba(255, 255, 255, 0.07);
        backdrop-filter: blur(15px);
        padding: 45px;
        border-radius: 25px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        animation: fadeInPop 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    @keyframes fadeInPop {
        from { opacity: 0; transform: scale(0.9) translateY(30px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }

    .glass-card h2 {
        margin-top: 0;
        margin-bottom: 10px;
        font-size: 28px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .subtitle {
        color: #cfe8ff;
        font-size: 15px;
        margin-bottom: 35px;
        opacity: 0.9;
    }

    /* Estilização dos Grupos de Formulário */
    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        margin-bottom: 10px;
        font-weight: 600;
        color: #00c6ff;
        letter-spacing: 0.5px;
    }

    .form-group input, 
    .form-group select, 
    .form-group textarea {
        width: 100%;
        padding: 16px;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        background: rgba(255, 255, 255, 0.95);
        color: #1a1a1a;
        font-size: 15px;
        outline: none;
        box-sizing: border-box;
        transition: all 0.3s ease;
    }

    /* Efeito de foco nos campos */
    .form-group input:focus, 
    .form-group select:focus, 
    .form-group textarea:focus {
        background: #fff;
        box-shadow: 0 0 0 4px rgba(0, 198, 255, 0.4);
        transform: translateY(-2px);
    }

    /* Grid responsivo para Setor e Categoria */
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
    }

    /* Ações e Botões */
    .actions {
        display: flex;
        align-items: center;
        gap: 25px;
        margin-top: 40px;
    }

    .btn-submit {
        flex: 2;
        background: linear-gradient(90deg, #00c6ff, #0072ff);
        color: white;
        padding: 18px;
        border: none;
        border-radius: 15px;
        font-weight: bold;
        font-size: 17px;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 5px 15px rgba(0, 114, 255, 0.3);
    }

    .btn-submit:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 12px 25px rgba(0, 198, 255, 0.5);
        filter: brightness(1.1);
    }

    .btn-cancel {
        flex: 1;
        text-align: center;
        color: #cfe8ff;
        text-decoration: none;
        font-size: 15px;
        font-weight: 500;
        transition: 0.3s;
    }

    .btn-cancel:hover {
        color: white;
        transform: translateX(-5px);
    }

    /* Ajustes para Celular */
    @media (max-width: 650px) {
        .glass-card {
            padding: 30px 20px;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .actions {
            flex-direction: column;
            gap: 20px;
        }

        .btn-submit {
            width: 100%;
            order: 1;
        }

        .btn-cancel {
            order: 2;
        }
    }

    ::placeholder {
        color: #999;
    }
</style>

<div class="container">
    <div class="glass-card">
        <h2>🚀 Abrir Nova Solicitação</h2>
        <p class="subtitle">Preencha os campos abaixo para que nossa equipe técnica possa te ajudar.</p>

        <form action="{{ route('os.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>O QUE ESTÁ ACONTECENDO? (TÍTULO)</label>
                <input type="text" name="titulo" required placeholder="Ex: Meu computador não liga ou internet lenta">
            </div>

           <div class="form-row">
                <div class="form-group">
                    <label>QUAL É O SEU SETOR?</label>
                    <select name="setor" required>
                        <option value="">Selecione...</option>
                        <option value="Financeiro">💼 Financeiro</option>
                        <option value="RH">👥 RH</option>
                        <option value="TI">💻 TI</option>
                        <option value="Marketing">📈 Marketing</option>
                        <option value="Comercial">📞 Comercial</option>
                        <option value="Outros">⚙️ Outros</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>CATEGORIA</label>
                    <select name="categoria" required>
                        <option value="">Selecione...</option>
                        <option value="Hardware">💻 Hardware</option>
                        <option value="Software">💿 Software</option>
                        <option value="Rede">🌐 Rede / Internet</option>
                        <option value="Outros">⚙️ Outros</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>EQUIPAMENTO (OPCIONAL)</label>
                <input type="text" name="equipamento" placeholder="Ex: Notebook Dell Patrimônio 1234">
            </div>

            <div class="form-group">
                <label>DESCRIÇÃO DETALHADA DO PROBLEMA</label>
                <textarea name="descricao" rows="5" required placeholder="Descreva aqui o que aconteceu, se aparece algum erro na tela, etc..."></textarea>
            </div>

            <div class="actions">
                <button type="submit" class="btn-submit">Enviar Chamado agora</button>
                <a href="{{ route('dashboard.usuario') }}" class="btn-cancel">Desistir e voltar</a>
            </div>
        </form>
    </div>
</div>

@endsection