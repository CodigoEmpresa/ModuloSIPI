<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Idrd\Usuarios\Seguridad\TraitSeguridad;

class PrecioOficial extends Model
{
    protected $table = 'Precios_Oficiales';
    protected $primaryKey = 'Id';
    protected $fillable = ['Id_Insumo', 'Persona_Id', 'Precio_Oficial', 'Precio_Oficial_Fecha', 'Precio_Oficial_Calculo', 'IVA'];
	
	public function __construct()
    {
        parent::__construct();
    }

    public function insumos()
    {
        return $this->belongsTo('App\Modelos\Insumo', 'Id_Insumo');
    }

    public function persona()
    {
        return $this->belongsTo('App\Modelos\Persona', 'Persona_Id');
    }
    
    use TraitSeguridad;
}
