<?php

namespace App\Modelos;

use Idrd\Usuarios\Repo\Persona as MPersona;

class Persona extends MPersona
{
	public function ficha_tecnica()
	{
        return $this->hasMany('App\Modelos\FichaTecnica', 'Persona_Id');
    }

	public function toFriendlyString()
	{
		return trim(strtoupper($this->Primer_Nombre.' '.$this->Primer_Apellido));
	}

	public function toString()
	{
		return trim(strtoupper($this->Primer_Apellido.' '.$this->Segundo_Apellido.' '.$this->Primer_Nombre.' '.$this->Segundo_Nombre));
	}
}