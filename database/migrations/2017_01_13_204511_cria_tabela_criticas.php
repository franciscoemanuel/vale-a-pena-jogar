<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaTabelaCriticas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criticas', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->increments('idCritica');
            $table->text('comentario');
            $table->integer('nota');
            $table->integer('idJogo');
            $table->integer('idUsuario');
            $table->foreign('idJogo')->references('idJogo')->on('jogos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idUsuario')->references('idUsuario')->on('usuarios')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('criticas');
    }
}
