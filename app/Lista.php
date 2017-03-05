<?php

namespace vapj;

use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
	protected $fillable = ['nomeLista, descricaoLista, idUsuario'];

	protected $primaryKey = "idLista";

	public $timestamps = false;

	//Retorna usuário que criou a lista
    public function usuario(){
    	return $this->belongsTo('vapj\User', 'idUsuario');
    }

    //Retorna jogos da lista
    public function jogos(){
    	return $this->belongsToMany('vapj\Jogo', 'lista_jogos', 'idLista', 'idJogo');
    }

    //Retorna curtidas da lista
    public function curtidas(){
        return $this->hasMany('vapj\Curtida', 'idLista');
    }

    //Retorna comentários da lista
    public function comentarios(){
        return $this->hasMany('vapj\Comentario', 'idLista');
    }
    
}
