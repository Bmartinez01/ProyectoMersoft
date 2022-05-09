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
        Schema::create('compra__detalles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('compras_id');
            $table->string('cantidad');
            $table->unsignedBigInteger('producto');
            $table->string('precio');
            $table->boolean('estado')->nullable()->default(1);
            $table->timestamps();

            $table->foreign('producto')->references('id')->on('productos');
            $table->foreign('compras_id')->references('id')->on('compras')->onDelete("cascade");

        });}

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
