<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin
        $admin_permissions = Permission::all();
        Role::findOrfail(1)->permissions()->sync($admin_permissions->pluck('id'));

        //empleado
        $empleado_permissions = $admin_permissions->filter(function($permission){
            return substr($permission->name,0,8)!='usuario_' &&
                substr($permission->name,0,4) != 'rol_' &&
                substr($permission->name,0,8) != 'permiso_';
        });
        Role::findOrfail(2)->permissions()->sync($empleado_permissions);
    }
}
