<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate([
            'dni'           => '45532962',
            'name'          => 'ilandbz',
            'direccion'     => '',
            'telefono'      => '',
            'email'         => 'cristianfigueroa19@hotmail.com',
            'password'      => Hash::make('123456789'),
            'id_tipo_user'  => 1
        ]);
    }
}
