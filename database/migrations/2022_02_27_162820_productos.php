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
            $table->string('Nombre');
            $table->bigInteger('Categorías')->unsigned();
            $table->string('Stock')->default(0);
            $table->string('precio');
            $table->boolean('estado')->nullable()->default(1);
            $table->timestamps();
            $table->foreign('Categorías')->references('id')->on('categorias')->onDelete("cascade");
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
            Schema::table('productos', function (Blueprint $table) {
                $table->string('unidad')->after('Nombre');
            });
    }
};
