<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prestamo extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_cliente',
        'id_usuario',
        'fecha',
        'fechavencimiento',
        'monto',
        'tasa',
        'total',
        'frecuencia',
        'periodo',
        'id_gestor',
        'saldo',
        'cuota',
        'zona',
        'estado'
    ];
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
    public function gestor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_gestor');
    }
}
