<?php

namespace vapj;

use Illuminate\Database\Eloquent\Model;

class Jogo extends Model
{
	//Campos que são permitidos serem preenchidos
	protected $fillable = array('nomeJogo','dataLancamento','descricao','quantidadeJogadores','idDistribuidora','idDesenvolvedor');
  
	//Não usa timestamps na tabela do modelo
    public $timestamps = false;

   public function setDataLancamentoAttribute($value)
	{
	    $this->attributes['dataLancamento'] = \Carbon\Carbon::createFromFormat('d/m/Y', $value);
	}

	public function categorias(){
		return $this->belongsToMany('vapj\Categoria', 'categoria_jogo', 'idJogo', 'idCategoria');
	}

	protected $primaryKey = "idJogo";
}
