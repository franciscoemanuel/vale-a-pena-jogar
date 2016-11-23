<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionaAvaliacaoAoRelacionamentoUsuarioJogo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuario_jogo', function (Blueprint $table) {
            $table->integer('avaliacao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('usuario_jogo', function (Blueprint $table) {
           $table->dropColumn('avaliacao');
       });
    }
}
