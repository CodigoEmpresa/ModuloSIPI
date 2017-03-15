<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Subdireccion extends Model
{
    protected $table = 'subdireccion';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre_Subidreccion'];

    public function Ficha_Tecnica(){
        return $this->hasMany('App\Models\Ficha_Tecnica', 'Subdireccion_Id');
    }
}