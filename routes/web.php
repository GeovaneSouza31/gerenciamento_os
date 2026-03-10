<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrdemServicoController;
use App\Http\Controllers\AdminController;

// redireciona para login
Route::get('/', function () {
    return redirect()->route('login');
});

// autenticação
Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// recuperação de senha e abertura de os automática
Route::get('/esqueceu-senha', function () {
    return view('auth.esqueceu-senha');
})->name('password.request');
Route::post('/esqueceu-senha', [UserController::class, 'handleForgotPassword'])->name('password.email');

// rotas protegidas para admin
Route::middleware(['auth', \App\Http\Middleware\CheckAdmin::class])->group(function () {
    
    // painel principal do admin
    Route::get('/dashboard-admin', [AdminController::class, 'dashboard'])->name('dashboard.admin');

    // listagem geral de os para o técnico
    Route::get('/admin/os', [AdminController::class, 'indexOs'])->name('admin.os.index');

    // tratamento de os pelo admin (movidas para dentro do grupo seguro)
    Route::get('/admin/os/{id}', [AdminController::class, 'show'])->name('admin.os.show');
    Route::put('/admin/os/{id}', [AdminController::class, 'update'])->name('admin.os.update');

    // gestão de usuários
    Route::get('/usuarios', [UserController::class, 'index'])->name('users.index');
    Route::post('/usuarios/store', [UserController::class, 'store'])->name('users.store');
});

// rotas para usuário comum
Route::middleware(['auth'])->group(function () {
    
    // painel do usuário
    Route::get('/dashboard-usuario', function () {
        return view('usuarios.dashboard');
    })->name('dashboard.usuario');

    // lista os chamados do usuário logado
    Route::get('/meus-chamados', [OrdemServicoController::class, 'index'])->name('os.index');

    // abertura de nova os
    Route::get('/os/nova', [OrdemServicoController::class, 'create'])->name('os.create');
    Route::post('/os/nova', [OrdemServicoController::class, 'store'])->name('os.store');
});