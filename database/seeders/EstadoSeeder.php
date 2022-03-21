<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // $estado = Estados::insert(
        //     [
        //         'Estado' => 'activo',
        //         'Tipo' => 'vendido'
        //     ]
        // );
        // $estado->save();

        $estado = [
            [
                'Estado' => 'Venta Directa',
                'Tipo' => 'Venta Directa'
            ],
            [
                'Estado' => 'Solicitado',
                'Tipo' => 'Domicilio'
            ],
            [
                'Estado' => 'En Proceso',
                'Tipo' => 'Domicilio'
            ],
            [
                'Estado' => 'Por Despachar',
                'Tipo' => 'Domicilio'
            ],
            [
                'Estado' => 'Enviado',
                'Tipo' => 'Domicilio'
            ],
            [
                'Estado' => 'Vendido',
                'Tipo' => 'Domicilio/venta directa'
            ]
        ];
        DB::table('estados')->insert($estado);
    }
}
