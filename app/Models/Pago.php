<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pago extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_usuario',
        'id_prestamo',
        'fecha',
        'monto'
    ];
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
    public function prestamo(): BelongsTo
    {
        return $this->belongsTo(Prestamo::class, 'id_prestamo');
    }
}
