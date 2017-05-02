<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'Items';
    protected $primaryKey = 'Id';
    protected $fillable = ['Codigo', 'Nombre' ,'Descripcion', 'Unidad_De_Medida'];

    public function fichasTecnicas()
    {
        return $this->belongsToMany('App\Modelos\FichaTecnica', 'Fichas_Tecnicas_Items', 'Id_Item', 'Id_Ficha')
                    ->withPivot('Cantidad');
    }

    public function insumos()
    {
        return $this->belongsToMany('App\Modelos\Insumo', 'Items_Insumos', 'Id_Item', 'Id_Insumo')
                        ->withPivot('Cantidad');
    }

    public function cotizaciones()
    {
        return $this->hasMany('App\Modelos\Cotizacion', 'Id_Item');
    }
}
