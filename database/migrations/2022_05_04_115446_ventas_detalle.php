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
        Schema::create('ventas_detalle', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('venta_id');
            $table->string('producto');
            $table->string('cantidad');
            $table->string('valor_total')->nullable();
            $table->string('producto_dev')->nullable();
            $table->string('producto_reg')->nullable();
            $table->string('valor_dev')->nullable();
            $table->string('valor_defi')->nullable();
            $table->timestamps();


        
            $table->foreign('venta_id')->references('id')->on('ventas')->onDelete("cascade");;
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
