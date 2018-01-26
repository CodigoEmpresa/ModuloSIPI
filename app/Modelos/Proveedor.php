<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Idrd\Usuarios\Seguridad\TraitSeguridad;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    protected $primaryKey = 'Id';
    protected $fillable = ['Id_Item', 'Nombre', 'Ciudad', 'Direccion' ,'Telefono', 'Email', 'Nombre_Contacto'];
	
	public function __construct()
    {
        parent::__construct();
    }

    public function insumos()
    {
        return $this->belongsToMany('App\Modelos\Insumo', 'cotizaciones', 'Id_Proveedor', 'Id_Insumo');
    }

    public function item()
    {
        return $this->belongsTo('App\Modelos\Item', 'Id_Item');
    }

    use TraitSeguridad;
}
