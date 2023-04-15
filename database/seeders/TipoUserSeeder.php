<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoUser;

class TipoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipouser = TipoUser::firstOrCreate(['nombre' => 'Administrador']);
        $tipouser = TipoUser::firstOrCreate(['nombre' => 'Supervisor']);
        $tipouser = TipoUser::firstOrCreate(['nombre' => 'Gestor']);
        $tipouser = TipoUser::firstOrCreate(['nombre' => 'Cliente']);
    }
}
