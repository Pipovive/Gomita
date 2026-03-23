<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ═══ CREAR ROLES ═══
        $rolAdmin   = Role::firstOrCreate(['name' => 'admin']);
        $rolCliente = Role::firstOrCreate(['name' => 'cliente']);

        // ═══ CREAR PERMISOS ═══
        $permisos = [
            'ver-productos',
            'crear-productos',
            'editar-productos',
            'eliminar-productos',
            'ver-categorias',
            'crear-categorias',
            'editar-categorias',
            'eliminar-categorias',
            'ver-cupones',
            'crear-cupones',
            'editar-cupones',
            'eliminar-cupones',
            'ver-pedidos',
            'ver-clientes',
            'ver-dashboard',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // admin tiene todos los permisos
        $rolAdmin->syncPermissions($permisos);

        // ═══ USUARIO ADMIN ═══
        $admin = User::firstOrCreate(
            ['email' => 'admin@gomita.com'],
            [
                'name'              => 'Administrador',
                'password'          => Hash::make('admin123456'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('admin');

        // ═══ USUARIO CLIENTE DE PRUEBA ═══
        $cliente = User::firstOrCreate(
            ['email' => 'laura@test.com'],
            [
                'name'              => 'Laura Pérez',
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $cliente->assignRole('cliente');

        $this->command->info('✅ Usuarios y roles creados');
    }
}
