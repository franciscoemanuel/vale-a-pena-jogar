<?php

namespace vapj;
use Illuminate\Database\Eloquent\Model;
class Distribuidora extends Model
{

	protected $fillable = array('nomeDistribuidora');
  
	public $timestamps = false;

	protected $primaryKey = "idDistribuidora";

	//Especifica que a relação de que um desenvolvedor pode desenvolver muitos jogos.
	public function jogos(){
		return $this->hasMany('vapj\Jogo', 'idDistribuidora');
	}
}
