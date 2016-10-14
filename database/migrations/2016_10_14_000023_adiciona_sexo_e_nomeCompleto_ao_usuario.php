<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionaSexoENomeCompletoAoUsuario extends Migration
{
    public function up()
    {
        Schema::table('usuarios', function($table){
            $table->char('sexo', 1);
            $table->string('nomeCompletoUsuario', 120);
        });
    }

    public function down()
    {
        Schema::table('usuarios', function($table){
            $table->dropColumn('sexo');
            $table->dropColumn('nomeCompletoUsuario');
        });
    }
}
