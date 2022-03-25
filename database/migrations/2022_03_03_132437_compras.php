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
        $table->string('fecha_compra')->nullable();
        $table->unsignedBigInteger('proveedor');
        $table->string('iva');
        $table->string('valor_total');
        $table->boolean('estado')->nullable()->default(1);
        $table->timestamps();

        $table->foreign('proveedor')->references('id')->on('proveedores');


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
