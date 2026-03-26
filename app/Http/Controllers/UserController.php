<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\OrdemServico; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\NovaSenhaMail;
use App\Models\Notification;

class UserController extends Controller
{

public function showLogin()
{
return view('auth.login');
}


public function login(Request $request)
{

$credentials = $request->validate([

'email'=>['required','email'],

'password'=>['required'],

]);

if(Auth::attempt($credentials)){

$request->session()->regenerate();

if(Auth::user()->perfil==='admin'){

return redirect()->intended('dashboard-admin');

}

return redirect()->intended('dashboard-usuario');

}

return back()->withErrors([

'email'=>'Credenciais inválidas'

]);

}


public function dashboardUsuario()
{
    $userId = Auth::id();

    $notificacoes = Notification::where('user_id', $userId)
        ->latest()
        ->get();

    return view('usuarios.dashboard', [
        'notificacoes' => $notificacoes
    ]);
}


/* LISTAGEM BASE */

public function index()
{

$users = User::latest()->get();

return $this->indexFiltro($users);

}


/* FILTRO ADMINS */

public function admins()
{

$users = User::where('perfil','admin')->get();

return $this->indexFiltro($users);

}


/* FILTRO USUÁRIOS */

public function usuarios()
{

$users = User::where('perfil','comum')->get();

return $this->indexFiltro($users);

}


/* FUNÇÃO BASE */

private function indexFiltro($users)
{

$total = User::count();

$admins = User::where('perfil','admin')->count();

$usuarios = User::where('perfil','comum')->count();

return view('admin.usuarios.index',compact(

'users',

'total',

'admins',

'usuarios'

));

}


/* CREATE */

public function create()
{

return view('admin.usuarios.create');

}


/* STORE */

public function store(Request $request)
{

$request->validate([

'name'=>'required|max:255',

'email'=>'required|email|unique:users',

'password'=>'required|min:6',

'perfil'=>'required|in:admin,comum',

]);

User::create([

'name'=>$request->name,

'email'=>$request->email,

'password'=>Hash::make($request->password),

'perfil'=>$request->perfil,

]);

return redirect()->route('users.index')
->with('success','Usuário cadastrado');

}


/* EDIT */

public function edit($id)
{

$user = User::findOrFail($id);

return view('admin.usuarios.edit',compact('user'));

}


/* UPDATE */

public function update(Request $request,$id)
{

$user = User::findOrFail($id);

$request->validate([

'name'=>'required|max:255',

'email'=>'required|email|unique:users,email,'.$user->id,

'perfil'=>'required|in:admin,comum',

'password'=>'nullable|min:6',

]);

$user->name=$request->name;

$user->email=$request->email;

$user->perfil=$request->perfil;

if($request->filled('password')){

$user->password=Hash::make($request->password);

}

$user->save();

return redirect()->route('users.index')
->with('success','Usuário atualizado');

}


/* DELETE */

public function destroy($id)
{

$user = User::findOrFail($id);

if($user->id==Auth::id()){

return back()->with('error',
'Você não pode excluir sua conta');

}

$user->delete();

return redirect()->route('users.index')
->with('success','Usuário removido');

}


/* LOGOUT */

public function logout(Request $request)
{

Auth::logout();

$request->session()->invalidate();

$request->session()->regenerateToken();

return redirect('/login');

}


/* ESQUECEU SENHA */

public function handleForgotPassword(Request $request)
{

$request->validate([

'email'=>'required|email'

]);

$usuario = User::where('email',$request->email)->first();

if($usuario){

/* GERA NOVA SENHA */

$novaSenha = Str::random(8);

/* SALVA */

$usuario->password = Hash::make($novaSenha);

$usuario->save();

/* ENVIA EMAIL */

Mail::to($usuario->email)
->send(new NovaSenhaMail($novaSenha,$usuario));

/* ABRE OS */

OrdemServico::create([

'user_id'=>$usuario->id,

'titulo'=>'Recuperação Senha',

'descricao'=>"Nova senha enviada para {$usuario->email}",

'setor'=>'SISTEMA',

'categoria'=>'Outros',

'status'=>'Concluído',

]);

return redirect()->route('login')
->with('success','Nova senha enviada por email');

}

return back()->withErrors([

'email'=>'Email não encontrado'

]);

}

}