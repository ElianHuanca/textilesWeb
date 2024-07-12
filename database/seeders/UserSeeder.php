<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'juanVendedor',
            'email' => 'juan@gmail.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('Vendedor');

        User::factory()->create([
            'name' => 'IselaVendedor',
            'email' => 'isela@gmail.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('Vendedor');

        User::factory()->create([
            'name' => 'EnriqueGerente',
            'email' => 'enrique@gmail.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('Gerente');
        
        User::factory()->create([
            'name' => 'mariaAlmacenera',
            'email' => 'maria@gmail.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('Almacenista');
    }
}
