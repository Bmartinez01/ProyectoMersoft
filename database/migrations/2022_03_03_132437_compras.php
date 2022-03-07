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
      //
      Schema::create('compras', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('recibo')->unique();
        $table->dateTimeTz('fecha_compra')->nullable();
        $table->unsignedBigInteger('proveedor');
        $table->string('cantidad');
        $table->unsignedBigInteger('producto');
        $table->string('valor_unitario');
        $table->string('valor_total');
        $table->boolean('estado')->nullable()->default(1);
        $table->timestamps();

        $table->foreign('proveedor')->references('id')->on('proveedores');
        $table->foreign('producto')->references('id')->on('productos');


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
