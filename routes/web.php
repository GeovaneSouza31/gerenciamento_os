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

// recuperação de senha
Route::get('/esqueceu-senha', function () {
    return view('auth.esqueceu-senha');
})->name('password.request');
Route::post('/esqueceu-senha', [UserController::class, 'handleForgotPassword'])->name('password.email');

// rotas protegidas para admin
Route::middleware(['auth', \App\Http\Middleware\CheckAdmin::class])->group(function () {
    
    // painel principal do admin
    Route::get('/dashboard-admin', [AdminController::class, 'dashboard'])->name('dashboard.admin');

    // listagem e tratamento de os
    Route::get('/admin/os', [AdminController::class, 'indexOs'])->name('admin.os.index');
    Route::get('/admin/os/{id}', [AdminController::class, 'show'])->name('admin.os.show');
    Route::put('/admin/os/{id}', [AdminController::class, 'update'])->name('admin.os.update');

    // GESTÃO DE USUÁRIOS (Completa)
    Route::get('/usuarios', [UserController::class, 'index'])->name('users.index');
    Route::get('/usuarios/novo', [UserController::class, 'create'])->name('users.create');
    Route::post('/usuarios/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/usuarios/{id}/editar', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/usuarios/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

// rotas para usuário comum
Route::middleware(['auth'])->group(function () {
    
    // painel do usuário
    Route::get('/dashboard-usuario', [UserController::class, 'dashboardUsuario'])->name('dashboard.usuario');

    // chamados do usuário
    Route::get('/meus-chamados', [OrdemServicoController::class, 'index'])->name('os.index');
    Route::get('/os/nova', [OrdemServicoController::class, 'create'])->name('os.create');
    Route::post('/os/nova', [OrdemServicoController::class, 'store'])->name('os.store');
});

//filtro
Route::middleware(['auth', \App\Http\Middleware\CheckAdmin::class])->group(function () {

Route::get('/dashboard-admin',
[AdminController::class,'dashboard'])
->name('dashboard.admin');


Route::get('/admin/os',
[AdminController::class,'indexOs'])
->name('admin.os.index');


/* FILTROS */

Route::get('/admin/os/pendentes',
[AdminController::class,'pendentes'])
->name('admin.os.pendentes');

Route::get('/admin/os/tratativa',
[AdminController::class,'tratativa'])
->name('admin.os.tratativa');

Route::get('/admin/os/concluidas',
[AdminController::class,'concluidas'])
->name('admin.os.concluidas');


/* ID SEMPRE POR ULTIMO */

Route::get('/admin/os/{id}',
[AdminController::class,'show'])
->whereNumber('id')
->name('admin.os.show');


Route::put('/admin/os/{id}',
[AdminController::class,'update'])
->whereNumber('id')
->name('admin.os.update');

});

//filtro adm e usuarios

Route::get('/usuarios',
[UserController::class,'index'])
->name('users.index');

Route::get('/usuarios/admins',
[UserController::class,'admins'])
->name('users.admins');

Route::get('/usuarios/users',
[UserController::class,'usuarios'])
->name('users.users');

//relatorios
Route::get('/relatorios', function () {
    return view('relatorios.index');
})->middleware('auth')->name('relatorios.index');  

Route::middleware(['auth', \App\Http\Middleware\CheckAdmin::class])
->group(function () {

    Route::get('/relatorios', function () {
        return view('relatorios.index');
    })->name('relatorios.index');

});

//rota para pdf

Route::get('/relatorios/pdf', [AdminController::class, 'exportarPdf'])
->middleware(['auth', \App\Http\Middleware\CheckAdmin::class])
->name('relatorios.pdf');