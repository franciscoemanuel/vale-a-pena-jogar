<?php

namespace vapj;

use Illuminate\Database\Eloquent\Model;

class Critica extends Model
{
	//Campos permitidos para atribuição em massa
	protected $fillable = ['nota', 'comentario', 'idJogo', 'idUsuario'];

	//Subscreve atributo que identifica a chave primária do modelo
	protected $primaryKey = "idCritica";

    //Retorna usuário que escreveu a crítica
    public function usuario(){
    	return $this->belongsTo('vapj\User', 'idUsuario');
    }

    //Retorna jogo que recebeu a crítica
    public function jogo(){
    	return $this->belongsTo('vapj\Jogo', 'idJogo');
    }

    //Retorna diferença de tempo entre a criação da crítica e o momento atual
    public function getDataCriacaoAttribute()
    {
      \Carbon\Carbon::setLocale('pt_BR');
      $date = \Carbon\Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans();
      return $date;
    }
}
