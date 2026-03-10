<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ordens_servico', function (Blueprint $coluna) {
            $coluna->id();
            
            //liga com quem abriu a OS
            $coluna->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            $coluna->string('titulo');
            $coluna->text('descricao');
            $coluna->string('setor'); // ainda temos que conversar sobre todos os campos ex: Administrativo, Produção, etc.
            
            // categorias fixas
            $coluna->enum('categoria', ['Hardware', 'Software', 'Rede', 'Outros']);
            
            $coluna->string('equipamento')->nullable();
            
            // O status para melhorar o fluxo 
            $coluna->enum('status', ['Pendente', 'Em Tratativa', 'Concluído'])
                   ->default('Pendente');

            $coluna->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ordens_servico');
    }
};