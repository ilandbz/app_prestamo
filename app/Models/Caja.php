<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Ramsey\Uuid\Type\Decimal;

class Caja extends Model
{
    use HasFactory;
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
    public static function saldo()
    {
        return Caja::orderBy('fecha', 'desc')->get()->value('saldo');
    }

}
