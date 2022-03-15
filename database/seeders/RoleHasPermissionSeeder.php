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
            return substr($permission->name,0,5)!='user_' &&
                substr($permission->name,0,5) != 'role_' &&
                substr($permission->name,0,11) != 'permission_';
        });
        Role::findOrfail(2)->permissions()->sync($empleado_permissions);
    }
}
