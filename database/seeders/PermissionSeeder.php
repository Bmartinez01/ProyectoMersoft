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
            'permission_index',
            'permission_create',
            'permission_edit',

            'role_index',
            'role_create',
            'role_edit',

            'user_index',
            'user_create',
            'user_edit',

            'categoria_index',
            'categoria_create',
            'categoria_edit',

            'proveedore_index',
            'proveedore_create',
            'proveedore_edit',

            'producto_index',
            'producto_create',
            'producto_edit',

            'cliente_index',
            'cliente_create',
            'cliente_edit',

        ];

        foreach ($permissions as $permission){
            Permission::create([
                'name'=> $permission
            ]);
        }
    }
}
