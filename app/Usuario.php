<?php

namespace vapj;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
   //Retira obrigação das colunas created_at e updated_at na tabela
   public $timestamps = false;
   //Campos que são permitidos serem passados através de uma request.
   protected $fillable = array('nomeUsuario','emailUsuario','senhaUsuario');

   protected $hidden = [
   		'password', 'remember_token',
   ];

}
