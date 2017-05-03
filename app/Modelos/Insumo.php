<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    protected $table = 'Insumos';
    protected $primaryKey = 'Id';
    protected $fillable = ['Id_Item', 'Nombre', 'Descripcion', 'Unidad_De_Medida', 'Precio_Oficial', 'Precio_Adjudicado', 'Precio_Oficial_Calculo'];

    public function item()
    {
        return $this->belongsTo('App\Modelos\Item', 'Id_Item');
    }

    public function cotizaciones()
    {
        return $this->hasMany('App\Modelos\Cotizacion', 'Id_Insumo');
    }

    public function fichasTecnicas()
    {
        return $this->belongsToMany('App\Modelos\FichaTecnica', 'Fichas_Tecnicas_Isumos', 'Id_Insumo', 'Id_Ficha')
                    ->withPivot('Cantidad');
    }
}
