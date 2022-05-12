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
        Schema::create('ventas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pedido_id');
            $table->unsignedBigInteger('cliente');
            $table->string('valor_inicial')->nullable();
            $table->string('valor_dev')->nullable();
            $table->string('valor_total')->nullable();
            $table->timestamps();

            $table->foreign('cliente')->references('id')->on('clientes');



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
