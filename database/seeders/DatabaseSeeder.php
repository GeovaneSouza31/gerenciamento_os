<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        \App\Models\User::create([
        'name' => 'Admin Manutenção',
        'email' => 'admin@empresa.com',
        'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
        'perfil' => 'admin'
        ]);

        
            \App\Models\User::create([
        'name' => 'Funcionário Teste',
        'email' => 'user@empresa.com',
        'password' => \Illuminate\Support\Facades\Hash::make('user123'),
        'perfil' => 'comum',
        ]);
    }
}
