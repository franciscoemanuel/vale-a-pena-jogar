<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionaNotaMediaENumCriticasEmJogos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jogos', function (Blueprint $table) {
            $table->float('notaMedia', 8, 2);
            $table->integer('numCriticas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jogos', function (Blueprint $table) {
            $table->dropColumn('notaMedia');
            $table->dropColumn('numCriticas');
        });
    }
}
