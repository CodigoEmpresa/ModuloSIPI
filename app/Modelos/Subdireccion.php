<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Idrd\Usuarios\Seguridad\TraitSeguridad;

class Subdireccion extends Model
{
    protected $table = 'subdireccion';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre_Subidreccion'];
	
	public function __construct()
    {
        parent::__construct();
    }

    public function fichasTecnicas()
    {
        return $this->hasMany('App\Models\Ficha_Tecnica', 'Subdireccion_Id');
    }

    use TraitSeguridad;
}