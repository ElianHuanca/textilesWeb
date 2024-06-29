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
            'name' => 'EnriqueAdmin',
            'email' => 'enrique@gmail.com',
        ])->assignRole('Gerente');

        User::factory()->create([
            'name' => 'juanVendedor',
            'email' => 'juan@gmail.com',
        ])->assignRole('Vendedor');

        User::factory()->create([
            'name' => 'mariaAlmacenera',
            'email' => 'maria@gmail.com',
        ])->assignRole('Almacenista');
    }
}
