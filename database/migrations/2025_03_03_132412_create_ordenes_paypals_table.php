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
        Schema::create('ordenes_paypals', function (Blueprint $table) {
            $table->id();
            $table->text('token');
            $table->string('orden');
            $table->string('nombre');
            $table->string('correo');
            $table->string('id_captura');
            $table->string('monto');
            $table->string('country_code',10);
            $table->string('paypal_request');
            $table->unsignedBigInteger('estado')->default(1);
            $table->dateTime('fecha')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes_paypals');
    }
};
