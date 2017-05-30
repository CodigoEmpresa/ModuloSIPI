<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class FichaTecnica extends Model
{
    protected $table = 'Fichas_Tecnicas';
    protected $primaryKey = 'Id';
    protected $fillable = ['Subdireccion_Id', 'Persona_Id', 'Anio', 'Codigo_Proceso', 'Objeto', 'Presupuesto_Estimado', 'Fecha_Entrega_Estimada', 'Observacion', 'Alcance1', 'Alcance2', 'Alcance3'];

    public function persona()
    {
        return $this->belongsTo('App\Modelos\Persona', 'Persona_Id');
    }

    public function administrador()
    {
        return $this->belongsTo('App\Modelos\Persona', 'Administrador_Id');
    }

    public function subdireccion()
    {
        return $this->belongsTo('App\Modelos\Subdireccion', 'Subdireccion_Id');
    }

    public function insumos()
    {
        return $this->belongsToMany('App\Modelos\Insumo', 'Fichas_Tecnicas_Insumos', 'Id_Ficha', 'Id_Insumo')
                    ->withPivot('Cantidad');
    }
}
