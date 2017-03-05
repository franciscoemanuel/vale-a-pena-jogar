<?php

namespace vapj;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    //Subscreve atributo que identifica a chave primária do modelo
    protected $primaryKey = "idComentario";

     /**
     * o nome da coluna "created at".
     * @var string
     */
    const CREATED_AT = 'criado_em';

    /**
     *  o nome da coluna "updated at".
     * @var string
     */
    const UPDATED_AT = 'editado_em';

    //Retorna diferença de tempo entre a criação do comentário e o momento atual
    public function getDataCriacaoAttribute()
    {
      \Carbon\Carbon::setLocale('pt_BR');
      $date = \Carbon\Carbon::createFromTimeStamp(strtotime($this->criado_em))->diffForHumans();
      return $date;
    }
    
    //Retorna usuário que comentou
    public function usuario(){
    	return $this->belongsTo('vapj\User', 'idUsuario');
    }

    //Retorna lista em que o comentário foi feito
    public function lista(){
    	return $this->belongsTo('vapj\Lista', 'idLista');
    }
}
