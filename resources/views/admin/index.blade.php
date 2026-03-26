@extends('layout.main')

@section('title', 'Gerenciar Chamados')

@section('content')

<style>
body {
margin:0;
background: linear-gradient(135deg,#0f2027,#203a43,#2c5364);
font-family:'Segoe UI';
color:white;
min-height:100vh;
}

.container{
padding:40px 20px;
max-width:1200px;
margin:auto;
}

.glass-card{
background:rgba(255,255,255,0.08);
backdrop-filter:blur(15px);
padding:35px;
border-radius:20px;
border:1px solid rgba(255,255,255,0.1);
box-shadow:0 15px 35px rgba(0,0,0,0.4);
}

.header-section{
margin-bottom:25px;
}

.subtitle{
color:#cfe8ff;
font-size:14px;
opacity:0.8;
}

/* CARDS */
.stat-area{
display:flex;
gap:15px;
margin-top:20px;
flex-wrap:wrap;
}

.stat-card{
background:rgba(255,255,255,0.05);
padding:15px 25px;
border-radius:12px;
text-align:center;
min-width:130px;
border:1px solid rgba(255,255,255,0.08);
}

.stat-card h3{
margin:0;
font-size:24px;
color:#00c6ff;
}

.stat-card p{
margin:0;
font-size:12px;
opacity:0.7;
}

/* FILTROS */

.filter-area{
margin-top:25px;
display:flex;
gap:10px;
flex-wrap:wrap;
}

.filter-btn{
border:none;
padding:10px 18px;
border-radius:8px;
font-weight:bold;
cursor:pointer;
background:rgba(255,255,255,0.08);
color:white;
transition:0.3s;
}

.filter-btn:hover{
transform:scale(1.05);
background:#00c6ff;
}

.pendente{
background:#ff9800;
}

.tratativa{
background:#00c6ff;
}

.concluido{
background:#4caf50;
}

/* TABELA */

.table-responsive{
width:100%;
overflow-x:auto;
border-radius:12px;
background:rgba(0,0,0,0.15);
margin-top:20px;
}

.custom-table{
width:100%;
border-collapse:collapse;
min-width:850px;
}

.custom-table th{
padding:18px 15px;
background:rgba(255,255,255,0.05);
text-align:left;
font-size:12px;
text-transform:uppercase;
letter-spacing:1px;
color:#00c6ff;
}

.custom-table td{
padding:18px 15px;
border-bottom:1px solid rgba(255,255,255,0.05);
font-size:14px;
}

.custom-table tbody tr:hover{
background:rgba(255,255,255,0.05);
box-shadow:inset 4px 0 0 #00c6ff;
}

.badge{
padding:6px 14px;
border-radius:50px;
font-size:11px;
font-weight:800;
text-transform:uppercase;
}

.status-pendente{
background:#ff9800;
}

.status-tratativa{
background:#00c6ff;
}

.status-concluido{
background:#4caf50;
}

.btn-view{
background:linear-gradient(90deg,#00c6ff,#0072ff);
color:white;
padding:8px 16px;
text-decoration:none;
border-radius:6px;
font-size:12px;
font-weight:bold;
transition:0.3s;
}

.btn-view:hover{
transform:scale(1.1);
box-shadow:0 0 15px rgba(0,198,255,0.5);
}

.btn-back{
display:inline-block;
margin-top:30px;
color:#cfe8ff;
text-decoration:none;
}

.btn-back:hover{
color:white;
}

.id-col{
color:rgba(255,255,255,0.4);
font-family:monospace;
font-weight:bold;
}

.user-col{
font-weight:600;
}
</style>


<div class="container">

<div class="glass-card">

<div class="header-section">

<h2>Gestão de Ordens de Serviço 🛠️</h2>

<p class="subtitle">
Abaixo estão todos os chamados registrados.
</p>

</div>


<!-- CARDS -->
<div class="stat-area">

<div class="stat-card">
<h3>{{$total}}</h3>
<p>Total</p>
</div>

<div class="stat-card">
<h3>{{$pendentes}}</h3>
<p>Pendentes</p>
</div>

<div class="stat-card">
<h3>{{$tratativa}}</h3>
<p>Em andamento</p>
</div>

<div class="stat-card">
<h3>{{$concluidas}}</h3>
<p>Concluídas</p>
</div>

</div>


<!-- FILTROS -->
<div class="filter-area">

<a href="{{route('admin.os.index')}}">
<button class="filter-btn">
Todas
</button>
</a>

<a href="/admin/os/pendentes">
<button class="filter-btn pendente">
Pendentes
</button>
</a>

<a href="/admin/os/tratativa">
<button class="filter-btn tratativa">
Em Tratativa
</button>
</a>

<a href="/admin/os/concluidas">
<button class="filter-btn concluido">
Concluídas
</button>
</a>

</div>


<div class="table-responsive">

<table class="custom-table">

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

<td class="id-col">
#{{ str_pad($os->id,4,'0',STR_PAD_LEFT) }}
</td>

<td class="user-col">

{{ $os->usuario->name ?? 'Sistema' }}

</td>

<td>

<strong>{{$os->titulo}}</strong>

</td>

<td>

{{$os->setor}}

</td>

<td>

{{$os->created_at->format('d/m/Y H:i')}}

</td>

<td>

@if($os->status=='Pendente')

<span class="badge status-pendente">
Pendente
</span>

@elseif($os->status=='Em Tratativa')

<span class="badge status-tratativa">
Em Tratativa
</span>

@else

<span class="badge status-concluido">
Concluído
</span>

@endif

</td>

<td>

<a href="{{route('admin.os.show',$os->id)}}"
class="btn-view">

Visualizar

</a>

</td>

</tr>

@empty

<tr>

<td colspan="7"
style="padding:60px;text-align:center;">

Nenhuma OS encontrada

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

<a href="{{route('dashboard.admin')}}"
class="btn-back">

⬅ Voltar

</a>

</div>

</div>

@endsection