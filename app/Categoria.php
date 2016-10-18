<?php

namespace vapj;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nomeCategoria'];

    protected $primaryKey = "idCategoria";

    public $timestamps = false;
}
