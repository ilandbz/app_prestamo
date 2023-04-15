<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'dni',
        'apellidos',
        'nombres',
        'direccionCasa',
        'direccionCobro',
        'telefono',
        'telefonoContacto'
    ];
    use HasFactory;
}
