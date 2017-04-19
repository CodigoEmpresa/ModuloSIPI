<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    protected $table = 'Insumos';
    protected $primaryKey = 'Id';
    protected $fillable = ['Codigo', 'Nombre' ,'Descripcion', 'Unidad_De_Medida'];

    public function items()
    {
        return $this->belongsToMany('App\Modelos\Item', 'Items_Insumos', 'Id_Insumo', 'Id_Item')
                        ->withPivot('Cantidad');
    }
}
