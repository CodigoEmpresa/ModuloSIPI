<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    protected $table = 'Cotizaciones';
    protected $primaryKey = 'Id';
    protected $fillable = ['Id_Item', 'Id_Proveedor' ,'Precio', 'Fecha_Actualizacion', 'Observaciones'];

    public function insumo()
    {
        return $this->belongsTo('App\Modelos\Insumo', 'Id_Insumo');
    }

    public function proveedor()
    {
        return $this->belongsTo('App\Modelos\Proveedor', 'Id_Proveedor');
    }
}
