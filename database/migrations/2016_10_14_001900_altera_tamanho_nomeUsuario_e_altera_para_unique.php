<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlteraTamanhoNomeUsuarioEAlteraParaUnique extends Migration
{
    public function up()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->string('nomeUsuario', 40)->unique()->change();
        });
    }

    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
              $table->dropColumn('nomeUsuario');
        });
    }
}
