<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'telefono' =>'3108299121',
            'direccion'=>'calle 46 No. 51-03',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRole('Administrador');

    }
}
