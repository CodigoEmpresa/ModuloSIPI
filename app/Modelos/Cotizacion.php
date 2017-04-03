<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    protected $table = 'Cotizacones';
    protected $primaryKey = 'Id';
    protected $fillable = ['Id_Item', 'Id_Proveedor', 'Precio_Oficial' ,'Precio', 'Precio_Calculo', 'Fecha_Actualizacion'];
    
    public function items()
    {
        return $this->belongsTo('App\Modelos\Item', 'Id_Item');
    }

    public function proveedor()
    {
        return $this->belongsTo('App\Modelos\Proveedor', 'Id_Proveedor');
    }
}
