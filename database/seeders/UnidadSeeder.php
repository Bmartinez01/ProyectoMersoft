<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
            'unidad' => 'Unidad'
            ],
            [
            'unidad' => 'Libra'
            ],
            [
            'unidad' => 'Gramo'
            ],
            [
            'unidad' => 'Kilo'
            ],
            [
            'unidad' => 'Litro'
            ],
            [
            'unidad' => 'Mililitro'
            ]
        ];
        DB::table('productos')->insert($data);
    }
}
