<?php

namespace vapj;

use Illuminate\Database\Eloquent\Model;

class Desenvolvedor extends Model
{
	protected $fillable = ['nomeDesenvolvedor'];

	//Especifica que a relação de que uma distribuidora pode distribuir muitos jogos.
	public function jogos(){
		return $this->hasMany('vapj\Jogo', 'idDesenvolvedor');
	}

	protected $table = "desenvolvedores";

	protected $primaryKey = "idDesenvolvedor";

	public $timestamps = false;
}
