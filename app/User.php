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

    //Retorna jogos do usuário
    public function jogos(){
        return $this->belongsToMany('vapj\Jogo', 'usuario_jogo', 'idUsuario', 'idJogo');
    }

    //Retorna se o usuário possui o jogo ou não
    public function possuiJogo($idJogo){
        $jogo = $this->jogos()->where('usuario_jogo.idJogo', $idJogo)->first();
        return $jogo != null;
    }

    public function curtiuLista($idLista){
        $curtida = $this->curtidas()->where('idLista', $idLista)->first();
        return $curtida != null;
    }

    //Retorna nota do jogo em que o usuário fez a crítica
    public function criticaDoJogo($idJogo){
        $critica = $this->criticas()->where('idJogo', $idJogo)->first();
        /*return $critica != null ? $critica : null;*/
        return $critica;
    }

    //Retorna criticas do usuário
    public function criticas(){
        return $this->hasMany('vapj\Critica', 'idUsuario');
    }

    //Retorna listas do usuário
    public function listas(){
        return $this->hasMany('vapj\Lista', 'idUsuario');
    }

    //Retorna curtidas do usuário
    public function curtidas(){
        return $this->hasMany('vapj\Curtida', 'idUsuario');
    }

    //Retorna comentários do usuário
    public function comentarios(){
        return $this->hasMany('vapj\Comentario', 'idUsuario');
    }
}
