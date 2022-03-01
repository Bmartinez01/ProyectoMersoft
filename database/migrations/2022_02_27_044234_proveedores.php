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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nit_empresa')->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('empresa');
            $table->string('categoria_id');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('email')->unique();
            $table->boolean('estado')->nullable()->default(1);

           // $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->timestamps();
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
