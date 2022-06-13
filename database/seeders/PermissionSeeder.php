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
            'producto_descargar excel',

            'cliente_listar',
            'cliente_crear',
            'cliente_editar',

            'compra_listar',
            'compra_crear',
            'compra_ver detalle',
            'compra_cancelar',
            'compra_descargar pdf',
            'compra_descargar excel',
            'compra_informe',

            'pedido_listar',
            'pedido_crear',
            'pedido_editar',
            'pedido_ver detalle',
            'pedido_cancelar',
            'pedido_descargar pdf',
            'pedido_descargar excel',
            
            'venta_listar',
            'venta_ver detalle',
            'venta_descargar recibo',
            'venta_informe',
        ];

        foreach ($permissions as $permission){
            Permission::create([
                'name'=> $permission
            ]);
        }
    }
}
