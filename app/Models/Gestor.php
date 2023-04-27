<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gestor extends Model
{
    use HasFactory;
    protected $table='gestores';
    protected $fillable = [
        'id_usuario',
        'id_supervisor'
    ];
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

}
