@extends('layout.main')

@section('title', 'Acesso ao Sistema')

@section('content')

<style>

body{
    margin:0;
    background: linear-gradient(135deg,#0f2027,#203a43,#2c5364);
    font-family: Arial, Helvetica, sans-serif;
}

.login-container{
    display:flex;
    justify-content:center;
    align-items:center;
    height:90vh;
}

.login-box{
    width:380px;
    padding:40px;
    border-radius:12px;

    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(10px);

    box-shadow:0 0 25px rgba(0,0,0,0.4);
    color:white;
}

.login-box h2{
    text-align:center;
    margin-bottom:30px;
}

.input-group{
    margin-bottom:20px;
}

.input-group label{
    font-size:14px;
}

.input-group input{
    width:100%;
    padding:14px;
    border-radius:6px;
    border:none;
    margin-top:6px;
    outline:none;
}

.password-box{
    position:relative;
}

.password-box input{
    padding-right:50px;
}

.eye{
    position:absolute;
    right:12px;
    top:50%;
    transform:translateY(-50%);
    cursor:pointer;

    font-size:24px;
    width:30px;
    height:30px;

    display:flex;
    align-items:center;
    justify-content:center;

    user-select:none;
}

button{
    width:80%;
    padding:16px;
    border:none;
    border-radius:8px;

    background:linear-gradient(90deg,#00c6ff,#0072ff);

    color:white;
    font-weight:bold;
    font-size:18px;
    cursor:pointer;
    transition:0.3s;

    display:block;
    margin:30px auto 0 auto;
}

button:hover{
    transform:scale(1.05);
    box-shadow:0 0 12px #00c6ff;
}

.forgot{
    text-align:center;
    margin-top:20px;
}

.forgot a{
    color:#cfe8ff;
    text-decoration:none;
}

.forgot a:hover{
    text-decoration:underline;
}

</style>

<div class="login-container">

    <div class="login-box">

        <h2>🔐 Login</h2>

        <form action="/login" method="POST">
            @csrf

            <div class="input-group">
                <label>E-mail</label>
                <input type="email" name="email" required>
            </div>

            <div class="input-group password-box">
                <label>Senha</label>

                <input type="password" id="senha" name="password" required>

                <span class="eye" id="eye" onclick="toggleSenha()">👁</span>

            </div>

            <button type="submit">Entrar</button>

            <div class="forgot">
                <a href="{{ route('password.request') }}">Esqueci minha senha</a>
            </div>

        </form>

    </div>

</div>

<script>
function toggleSenha() {

    const senha = document.getElementById("senha");
    const eye = document.getElementById("eye");

}
</script>

@endsection