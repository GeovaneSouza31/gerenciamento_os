<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('atendimentos_os', function (Blueprint $coluna) {
            $coluna->id();

            // feito pra garantir que apenas uma pessoa fique vinculada a OS
            $coluna->foreignId('os_id')->unique()->constrained('ordens_servico')->onDelete('cascade');

            // responsavel pela os
            $coluna->foreignId('admin_id')->constrained('users')->onDelete('cascade');

            $coluna->text('relato_tecnico')->nullable();
            
            
            $coluna->timestamp('data_inicio')->nullable();
            $coluna->timestamp('data_fim')->nullable();

            $coluna->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('atendimentos_os');
    }
};