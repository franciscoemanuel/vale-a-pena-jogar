<?php

namespace vapj;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    //Campos que são permitidos serem preenchidos
    protected $fillable = array('nomeUsuario','senhaUsuario','emailUsuario','sexo','nomeCompletoUsuario','dataNascimentoUsuario');
  
    //Tabela do banco que é usada pra criar o modelo
    protected $table = "usuarios";

    //Chave primária da tabela
    protected $primaryKey = "idUsuario";

    //Atributos que não são incluidos em representações do modelo em arrays ou Json.
    protected $hidden = [
        'senhaUsuario', 'remember_token',
    ];

    public function getAuthIdentifier() {
        return $this->getKey();
    }

    public function getAuthPassword() {
        return $this->senhaUsuario;
    }

    public function getReminderEmail() {
        return $this->emailUsuario;
    }

    //Não usa timestamps na tabela do modelo
    public $timestamps = false;

    public function setDataNascimentoUsuarioAttribute($value)
    {
        $this->attributes['dataNascimentoUsuario'] = \Carbon\Carbon::createFromFormat('d/m/Y', $value);
    }

    public function jogos(){
        return $this->belongsToMany('vapj\Jogo', 'usuario_jogo', 'idUsuario', 'idJogo');
    }

    public function possuiJogo($idJogo){
        return $this->jogos()->where('usuario_jogo.idJogo', $idJogo)->first();
    }
}
