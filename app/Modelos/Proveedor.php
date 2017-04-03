<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'Proveedores';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre', 'Ciudad', 'Direccion' ,'Telefono', 'Email', 'Nombre_Contacto'];

    public function cotizaciones()
    {
        return $this->hasMany('App\Modelos\Cotizacion', 'Id_Proveedor');
    }
}
