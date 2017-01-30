<?php

namespace vapj;

use Illuminate\Database\Eloquent\Model;

class Jogo extends Model
{
	//Campos que são permitidos serem preenchidos
	protected $fillable = array('nomeJogo','dataLancamento','descricao','quantidadeJogadores','idDistribuidora','idDesenvolvedor');
  
	//Não usa timestamps na tabela do modelo
    public $timestamps = false;

    //Subscreve método de inserir data de lancamento no modelo
    public function setDataLancamentoAttribute($value)
	{
	    $this->attributes['dataLancamento'] = \Carbon\Carbon::createFromFormat('d/m/Y', $value);
	}

	//Retorna as categorias cadastradas para o jogo
	public function categorias(){
		return $this->belongsToMany('vapj\Categoria', 'categoria_jogo', 'idJogo', 'idCategoria');
	}

	//Retorna a distribuidora do jogo
	public function distribuidora(){
		return $this->belongsTo('vapj\Distribuidora', 'idDistribuidora');
	}

	//Retorna o desenvolvedor do jogo
	public function desenvolvedor(){
		return $this->belongsTo('vapj\Desenvolvedor', 'idDesenvolvedor');
	}

	//Retorna críticas do jogo
	public function criticas(){
		return $this->hasMany('vapj\Critica', 'idJogo');
	}

	//Subscreve atributo que identifica a chave primária do modelo
	protected $primaryKey = "idJogo";

	//Atributo que indica quais campos deverão ser retornados como instâncias de um objeto Carbon
	protected $dates = ['dataLancamento'];
}
