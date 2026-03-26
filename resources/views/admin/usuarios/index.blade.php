@extends('layout.main')

@section('title', 'Gestão de Usuários')

@section('content')

<style>

body{
margin:0;
background: linear-gradient(135deg,#0f2027,#203a43,#2c5364);
font-family:'Segoe UI',sans-serif;
color:white;
min-height:100vh;
}

.container{
padding:40px 20px;
max-width:1100px;
margin:0 auto;
}

.glass-card{

background:rgba(255,255,255,0.07);

backdrop-filter:blur(15px);

padding:40px;

border-radius:25px;

border:1px solid rgba(255,255,255,0.1);

box-shadow:0 15px 35px rgba(0,0,0,0.4);

animation:fadeInPop 0.6s;

}

@keyframes fadeInPop{

from{
opacity:0;
transform:scale(0.9);
}

to{
opacity:1;
transform:scale(1);
}

}

.header-flex{

display:flex;

justify-content:space-between;

align-items:center;

margin-bottom:25px;

}

/* filtros */

.filter-area{

margin-bottom:20px;

display:flex;

gap:10px;

}

.filter-btn{

padding:8px 18px;

border-radius:20px;

border:none;

background:rgba(255,255,255,0.1);

color:white;

cursor:pointer;

transition:.3s;

}

.filter-btn:hover{

background:#00c6ff;

}

.active-filter{

background:linear-gradient(90deg,#00c6ff,#0072ff);

}

/* tabela */

.table-responsive{

width:100%;

overflow-x:auto;

border-radius:15px;

background:rgba(0,0,0,0.15);

}

.custom-table{

width:100%;

border-collapse:collapse;

min-width:700px;

}

.custom-table th{

padding:18px;

text-align:left;

color:#00c6ff;

font-size:12px;

text-transform:uppercase;

}

.custom-table td{

padding:18px;

border-bottom:1px solid rgba(255,255,255,0.05);

}

.btn-action{

padding:8px 15px;

border-radius:8px;

text-decoration:none;

font-size:13px;

font-weight:bold;

transition:.3s;

display:inline-block;

border:none;

cursor:pointer;

}

.btn-edit{

background:#ff9800;

color:white;

}

.btn-delete{

background:#f44336;

color:white;

}

.btn-new{

background:linear-gradient(90deg,#00c6ff,#0072ff);

color:white;

}

.btn-action:hover{

transform:scale(1.1);

filter:brightness(1.2);

}

.badge{

padding:5px 12px;

border-radius:50px;

font-size:11px;

font-weight:bold;

}

.bg-admin{

background:#00c6ff;

}

.bg-user{

background:rgba(255,255,255,0.2);

}

</style>


<div class="container">

<div class="glass-card">

<div class="header-flex">

<h2>👥 Gestão de Usuários</h2>

<a href="{{route('users.create')}}" class="btn-action btn-new">
+ Novo Usuário
</a>

</div>


<!-- FILTROS -->

<div class="filter-area">

<a href="{{route('users.index')}}">
<button class="filter-btn">
Todos
</button>
</a>


<a href="{{route('users.admins')}}">
<button class="filter-btn">
Admins
</button>
</a>


<a href="{{route('users.users')}}">
<button class="filter-btn">
Usuários
</button>
</a>

</div>


<div class="table-responsive">

<table class="custom-table">

<thead>

<tr>

<th>Nome</th>

<th>Email</th>

<th>Perfil</th>

<th>Ações</th>

</tr>

</thead>


<tbody>

@forelse($users as $user)

<tr>

<td>
<strong>{{$user->name}}</strong>
</td>

<td>
{{$user->email}}
</td>

<td>

<span class="badge {{$user->perfil=='admin'?'bg-admin':'bg-user'}}">

{{strtoupper($user->perfil)}}

</span>

</td>


<td style="display:flex;gap:10px;">

<a href="{{route('users.edit',$user->id)}}"
class="btn-action btn-edit">

✏️ Editar

</a>


<form action="{{route('users.destroy',$user->id)}}"
method="POST">

@csrf

@method('DELETE')

<button class="btn-action btn-delete">

🗑️

</button>

</form>

</td>

</tr>

@empty

<tr>

<td colspan="4"
style="text-align:center;
padding:40px;
opacity:.5;">

Nenhum usuário encontrado

</td>

</tr>

@endforelse

</tbody>

</table>

</div>


<a href="{{route('dashboard.admin')}}"
style="display:inline-block;
margin-top:20px;
color:#cfe8ff;
text-decoration:none;">

⬅ Voltar ao Painel

</a>

</div>

</div>

@endsection