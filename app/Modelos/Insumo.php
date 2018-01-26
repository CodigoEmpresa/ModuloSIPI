<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Idrd\Usuarios\Seguridad\TraitSeguridad;

class Insumo extends Model
{
    protected $table = 'insumos';
    protected $primaryKey = 'Id';
    protected $fillable = ['Id_Item', 'Nombre', 'Descripcion', 'Unidad_De_Medida', 'Precio_Oficial', 'Precio_Adjudicado', 'Precio_Oficial_Calculo', 'Precio_Oficial_Fecha', 'Foto_1', 'Foto_2', 'Foto_3'];

    public function __construct()
    {
        parent::__construct();
    }

    public function item()
    {
        return $this->belongsTo('App\Modelos\Item', 'Id_Item');
    }

    public function proveedores()
    {
        return $this->belongsToMany('App\Modelos\Proveedor', 'cotizaciones', 'Id_Insumo', 'Id_Proveedor');
    }

    public function fichasTecnicas()
    {
        return $this->belongsToMany('App\Modelos\FichaTecnica', 'fichas_tecnicas_isumos', 'Id_Insumo', 'Id_Ficha')
                    ->withPivot('Cantidad');
    }

    use TraitSeguridad;
}
