<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Caja;
use App\Models\User;
use Carbon\Carbon;
class CajaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $usuario = User::first();
        $fecha = Carbon::today();
        $monto = 6000.00;
        $descripcion = 'Ingreso inicial';
        $tipo = 'INGRESO';
        $saldo = $monto;

        Caja::firstOrCreate([
            'fecha' => $fecha,
            'id_usuario' => $usuario->id,
            'monto' => $monto,
            'tipo' => $tipo,
            'saldo' => $saldo,
            'descripcion' => $descripcion,
        ]);
    }
}
