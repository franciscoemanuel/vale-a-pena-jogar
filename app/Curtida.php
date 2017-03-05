<?php

namespace vapj;

use Illuminate\Database\Eloquent\Model;

class Curtida extends Model
{

     /**
     * o nome da coluna "created at".
     * @var string
     */
    const CREATED_AT = 'criado_em';

    /**
     *  Desabilita timestamp de atualização do registro
     * @var string
     */
    const UPDATED_AT = null;

	//Subscreve atributo que identifica a chave primária do modelo
	protected $primaryKey = "idCurtida";

    //Retorna usuário que curtiu
    public function usuario(){
    	return $this->belongsTo('vapj\User', 'idUsuario');
    }

    //Retorna comentário que foi curtido
    public function lista(){
    	return $this->belongsTo('vapj\Lista', 'idLista');
    }

    //Retorna diferença de tempo entre a criação do comentário e o momento atual
    public function getDataCriacaoAttribute()
    {
      \Carbon\Carbon::setLocale('pt_BR');
      $date = \Carbon\Carbon::createFromTimeStamp(strtotime($this->criado_em))->diffForHumans();
      return $date;
    }
}
