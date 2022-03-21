<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'permiso_listar',
            'permiso_crear',
            'permiso_editar',

            'rol_listar',
            'rol_crear',
            'rol_editar',

            'usuario_listar',
            'usuario_crear',
            'usuario_editar',

            'categoria_listar',
            'categoria_crear',
            'categoria_editar',

            'proveedor_listar',
            'proveedor_crear',
            'proveedor_editar',

            'producto_listar',
            'producto_crear',
            'producto_editar',

            'cliente_listar',
            'cliente_crear',
            'cliente_editar',

        ];

        foreach ($permissions as $permission){
            Permission::create([
                'name'=> $permission
            ]);
        }
    }
}
