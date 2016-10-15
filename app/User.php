<?php

namespace vapj;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = array('nomeUsuario','senhaUsuario','emailUsuario','sexo','nomeCompletoUsuario','dataNascimentoUsuario');
  
    protected $table = "usuarios";
    protected $primaryKey = "idUsuario";

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

    public $timestamps = false;
}
