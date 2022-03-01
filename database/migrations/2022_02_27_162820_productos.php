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
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Código')->unique();
            $table->string('Nombre');
            $table->bigInteger('Categorías_id')->unsigned();
            $table->string('Stock');
            $table->string('precio');
            $table->boolean('estado')->nullable()->default(1);

            $table->foreign('Categorías_id')->references('id')->on('categorias');
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
            Schema::dropIfExists('users');
    }
};
