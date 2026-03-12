<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\OrdemServico; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 

class UserController extends Controller
{
    // Exibe a tela de login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Processa o login e redireciona conforme o perfil
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->perfil === 'admin') {
                return redirect()->intended('dashboard-admin');
            }
            return redirect()->intended('dashboard-usuario');
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->onlyInput('email');
    }

    // Exibe o painel principal do usuário comum (Resolve o erro do seu print)
    public function dashboardUsuario()
    {
        return view('usuarios.dashboard');
    }

    // Lista todos os usuários na pasta admin/usuarios
    public function index()
    {
        $users = User::all();
        return view('admin.usuarios.index', compact('users'));
    }

    // Abre o formulário de novo usuário
    public function create()
    {
        return view('admin.usuarios.create');
    }

    // Salva novo usuário com senha mínima de 6 caracteres
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'perfil' => 'required|in:admin,comum',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'perfil' => $request->perfil,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuário cadastrado!');
    }

    // Abre o formulário de edição na pasta correta
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.usuarios.edit', compact('user'));
    }

    // Atualiza dados e permite senha opcional (mínimo 6)
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'perfil' => 'required|in:admin,comum',
            'password' => 'nullable|min:6',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->perfil = $request->perfil;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        return redirect()->route('users.index')->with('success', 'Usuário atualizado!');
    }

    // Deleta usuário e bloqueia suicídio de conta logada
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'Você não pode excluir sua própria conta!');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuário removido!');
    }

    // Desloga o usuário e limpa a sessão
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // Abre O.S. automática para reset de senha
    public function handleForgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $usuario = User::where('email', $request->email)->first();

        if ($usuario) {
            OrdemServico::create([
                'user_id' => $usuario->id,
                'titulo' => 'Recuperação de Senha',
                'descricao' => "O usuário {$usuario->name} solicitou o reset de senha.",
                'setor' => 'SISTEMA',
                'categoria' => 'Outros',
                'status' => 'Pendente',
            ]);

            return redirect()->route('login')->with('success', 'Chamado aberto! Aguarde o reset.');
        }

        return back()->withErrors(['email' => 'E-mail não encontrado.']);
    }
}