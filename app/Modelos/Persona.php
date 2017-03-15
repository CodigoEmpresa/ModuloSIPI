<?php

namespace App\Modelos;

use Idrd\Usuarios\Repo\Persona as MPersona;

class Persona extends MPersona
{
	public function ficha_tecnica(){
        return $this->hasMany('App\Models\FichaTecnica', 'Persona_Id');
    }
}