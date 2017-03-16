<?php

namespace vapj;

use Illuminate\Database\Eloquent\Model;

class Jogo extends Model
{
	//Campos que são permitidos serem preenchidos
	protected $fillable = array('nomeJogo','dataLancamento','descricao','quantidadeJogadores','idDistribuidora','idDesenvolvedor', 'imagemJogo', 'aprovado');
  
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

	//Retorna usuário que já jogaram o jogo
	public function usuario(){
		return $this->belongsToMany('vapj\Jogo', 'usuario_jogo', 'idJogo', 'idUsuario');
	}

	//Subscreve atributo que identifica a chave primária do modelo
	protected $primaryKey = "idJogo";

	//Atributo que indica quais campos deverão ser retornados como instâncias de um objeto Carbon
	protected $dates = ['dataLancamento'];

	//Retorna data de de lançamento formatada
	public function getDataLancamentoAttribute(){
		$date = \Carbon\Carbon::parse($this->attributes['dataLancamento'])->format('d/m/Y');
		return $date;
	}

	//Retorna nota média com uma casa depois da virgula
	public function getNotaMediaAttribute(){
		return number_format($this->attributes['notaMedia'], 1);
	}

	/**
    * Filtra a query para somente jogos sugeridos
    *
    * @param \Illuminate\Database\Eloquent\Builder $query
    * @return \Illuminate\Database\Eloquent\Builder
    */
	public function scopeSugeridos($query){
		return $query->where('aprovado', false);
	}

	/**
    * Filtra a query para somente jogos já aprovados
    *
    * @param \Illuminate\Database\Eloquent\Builder $query
    * @return \Illuminate\Database\Eloquent\Builder
    */
	public function scopeAprovados($query){
		return $query->where('aprovado', true);
	}
}
