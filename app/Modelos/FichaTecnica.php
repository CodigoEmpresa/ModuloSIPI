<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class FichaTecnica extends Model
{
    protected $table = 'ficha_tecnica';
    protected $primaryKey = 'Id';
    protected $fillable = ['Subdireccion_Id', 'Persona_Id', 'Anio', 'Codigo_Proceso', 'Objeto', 'Presupuesto_Estimado', 'Fecha_Entrega_Estimada', 'Observacion'];

    public function persona(){
        return $this->belongsTo('App\Models\Persona', 'Persona_Id');
    }

    public function subdireccion(){
        return $this->belongsTo('App\Models\Subdireccion', 'Subdireccion_Id');
    }
}