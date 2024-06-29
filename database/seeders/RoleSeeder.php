<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Gerente']);
        $role2 = Role::create(['name' => 'Almacenista']);
        $role3 = Role::create(['name' => 'Vendedor']);

        Permission::create(['name' => 'users.index', 
                            'description' => 'Ver lista de usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'users.create', 
                            'description' => 'Crear un usuario'])->syncRoles([$role1]);
        Permission::create(['name' => 'users.edit', 
                            'description' => 'Editar usuario'])->syncRoles([$role1]);
        Permission::create(['name' => 'users.destroy', 
                            'description' => 'Eliminar usuario'])->syncRoles([$role1]);

        Permission::create(['name' => 'almacenes.index', 
                            'description' => 'Ver lista de almacenes'])->syncRoles([$role1]);
        Permission::create(['name' => 'almacenes.create', 
                            'description' => 'Crear almacenes'])->syncRoles([$role1]);
        Permission::create(['name' => 'almacenes.edit', 
                            'description' => 'Editar almacenes'])->syncRoles([$role1]);
        Permission::create(['name' => 'almacenes.destroy', 
                            'description' => 'Eliminar almacenes'])->syncRoles([$role1]);

        Permission::create(['name' => 'sucursales.index', 
                            'description' => 'Ver lista de sucursales'])->syncRoles([$role1]);
        Permission::create(['name' => 'sucursales.create', 
                            'description' => 'Crear sucursales'])->syncRoles([$role1]);
        Permission::create(['name' => 'sucursales.edit', 
                            'description' => 'Editar sucursales'])->syncRoles([$role1]);
        Permission::create(['name' => 'sucursales.destroy', 
                            'description' => 'Eliminar sucursales'])->syncRoles([$role1]);

        Permission::create(['name' => 'telas.index', 
                            'description' => 'Ver lista de telas'])->syncRoles([$role1]);
        Permission::create(['name' => 'telas.create', 
                            'description' => 'Crear telas'])->syncRoles([$role1]);
        Permission::create(['name' => 'telas.edit', 
                            'description' => 'Editar telas'])->syncRoles([$role1]);
        Permission::create(['name' => 'telas.destroy', 
                            'description' => 'Eliminar telas'])->syncRoles([$role1]);
        
        Permission::create(['name' => 'proveedores.index', 
                            'description' => 'Ver lista de proveedores'])->syncRoles([$role1]);
        Permission::create(['name' => 'proveedores.create', 
                            'description' => 'Crear proveedores'])->syncRoles([$role1]);
        Permission::create(['name' => 'proveedores.edit', 
                            'description' => 'Editar proveedores'])->syncRoles([$role1]);
        Permission::create(['name' => 'proveedores.destroy', 
                            'description' => 'Eliminar proveedores'])->syncRoles([$role1]);

        Permission::create(['name' => 'tipogastos.index', 
                            'description' => 'Ver lista de tipogastos'])->syncRoles([$role1]);
        Permission::create(['name' => 'tipogastos.create', 
                            'description' => 'Crear tipogastos'])->syncRoles([$role1]);
        Permission::create(['name' => 'tipogastos.edit', 
                            'description' => 'Editar tipogastos'])->syncRoles([$role1]);
        Permission::create(['name' => 'tipogastos.destroy', 
                            'description' => 'Eliminar tipogastos'])->syncRoles([$role1]);

        Permission::create(['name' => 'compras.index', 
                            'description' => 'Ver lista de compras'])->syncRoles([$role1]);
        Permission::create(['name' => 'compras.create', 
                            'description' => 'Crear compras'])->syncRoles([$role1]);
        Permission::create(['name' => 'compras.edit', 
                            'description' => 'Editar compras'])->syncRoles([$role1]);
        Permission::create(['name' => 'compras.destroy', 
                            'description' => 'Eliminar compras'])->syncRoles([$role1]);
        
        Permission::create(['name' => 'ventas.index', 
                            'description' => 'Ver lista de ventas'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'ventas.create', 
                            'description' => 'Crear ventas'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'ventas.edit', 
                            'description' => 'Editar ventas'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'ventas.destroy', 
                            'description' => 'Eliminar ventas'])->syncRoles([$role1,$role3]);


    }
 
}
