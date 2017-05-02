<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class FichaTecnica extends Model
{
    protected $table = 'ficha_tecnica';
    protected $primaryKey = 'Id';
    protected $fillable = ['Subdireccion_Id', 'Persona_Id', 'Anio', 'Codigo_Proceso', 'Objeto', 'Presupuesto_Estimado', 'Fecha_Entrega_Estimada', 'Observacion', 'Alcance1', 'Alcance2', 'Alcance3'];

    public function persona(){
        return $this->belongsTo('App\Modelos\Persona', 'Persona_Id');
    }

    public function subdireccion(){
        return $this->belongsTo('App\Modelos\Subdireccion', 'Subdireccion_Id');
    }

    public function items()
    {
        return $this->belongsToMany('App\Modelos\Item', 'Fichas_Tecnicas_Items', 'Id_Ficha', 'Id_Item')
                    ->withPivot('Cantidad');
    }
}
