<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Idrd\Usuarios\Seguridad\TraitSeguridad;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre', 'Ciudad', 'Direccion' ,'Telefono', 'Email', 'Nombre_Contacto'];
	
	public function __construct()
    {
        parent::__construct();
    }

    public function cotizaciones()
    {
        return $this->hasMany('App\Modelos\Cotizacion', 'Id_Proveedor');
    }

    use TraitSeguridad;
}
