<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_detalles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pedido');
            $table->unsignedBigInteger('cliente');
            $table->unsignedBigInteger('producto');
            $table->string('cantidad');
            $table->string('valor_unitario');
            $table->string('valor_total');
            $table->unsignedBigInteger('estado');
            $table->timestamps();

            $table->foreign('cliente')->references('id')->on('clientes');
            $table->foreign('producto')->references('id')->on('productos');
            $table->foreign('estado')->references('id')->on('estados');
            $table->foreign('pedido')->references('id')->on('pedidos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
