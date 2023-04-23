<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_cliente')->constrained('clientes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_usuario')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->dateTime('fecha');
            $table->date('fechavencimiento');
            $table->double('monto');
            $table->double('tasa');
            $table->double('total');
            $table->string('frecuencia')->default('Diario');
            $table->integer('periodo');
            $table->double('saldo')->default(0);
            $table->decimal('cuota');
            $table->foreignId('id_gestor')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('zona');
            $table->tinyInteger('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};
