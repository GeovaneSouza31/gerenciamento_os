<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\OrdemServico; // Importação necessária para criar a O.S.
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 

class UserController extends Controller
{
    // tela de login
    public function showLogin()
    {
        return view('auth.login');
    }

    // processar a tela de login
    public function login(Request $request)
    {
        // Validação: ***
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

            // garante credenciais ***
        if (Auth::attempt($credentials)) {
            
            //Segurança de Sessão: Gera um novo ID de sessão para evitar ataques ***
            $request->session()->regenerate();

            // Verifica o perfil para ver nivel de acesso 
            if (Auth::user()->perfil === 'admin') {
                return redirect()->intended('dashboard-admin');
            }

            return redirect()->intended('dashboard-usuario');
        }

        // trata falha no login caso os dados não de match, volta pro formulario ****
        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->onlyInput('email'); // Mantém o e-mail digitado para o usuário não ter que digitar de novo ***
    }

    // lista todos os usuários para o admin
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Processa o cadastro de novos usuários (Feito pelo Admin)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'perfil' => 'required|in:admin,comum',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'perfil' => $request->perfil,
        ]);

        return redirect()->back()->with('success', 'Usuário cadastrado com sucesso!');
    }

    //implementação do logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // Processa a solicitação de esqueci a senha e gera uma O.S automática para o Admin
    public function handleForgotPassword(Request $request)
    {
        // Valida se o e-mail existe na requisição
        $request->validate(['email' => 'required|email']);

        // Busca o usuário pelo e-mail informado
        $usuario = User::where('email', $request->email)->first();

        if ($usuario) {
            // Cria a Ordem de Serviço vinculada ao usuário que esqueceu a senha
            OrdemServico::create([
                'user_id' => $usuario->id,
                'titulo' => 'Recuperação de Senha',
                'descricao' => "O usuário {$usuario->name} solicitou o reset de senha. Tratar via banco de dados ou painel admin.",
                'setor' => 'SISTEMA',
                'categoria' => 'Outros',
                'status' => 'Pendente',
            ]);

            return redirect()->route('login')->with('success', 'Chamado de recuperação aberto! Aguarde o reset pelo administrador.');
        }

        // Caso o e-mail não seja encontrado, retorna com erro
        return back()->withErrors(['email' => 'E-mail não encontrado em nosso sistema.']);
    }
}