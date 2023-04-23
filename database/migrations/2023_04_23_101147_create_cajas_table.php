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
        Schema::create('cajas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha');
            $table->foreignId('id_usuario')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('monto', 9,2);
            $table->string('tipo')->default('INGRESO');
            $table->decimal('saldo', 9,2);
            $table->string('descripcion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cajas');
    }
};
