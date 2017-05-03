<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'Items';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre' ,'Descripcion'];

    public function insumos()
    {
        return $this->hasMany('App\Modelos\Insumo', 'Id_Item');
    }
}
