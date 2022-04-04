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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cliente');
            $table->string('valor_total');
            $table->unsignedBigInteger('estado');
            $table->unsignedBigInteger('tipo')->nullable();
            $table->timestamps();

            $table->foreign('cliente')->references('id')->on('clientes');
            $table->foreign('estado')->references('id')->on('estados');


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
