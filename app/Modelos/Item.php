<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Idrd\Usuarios\Seguridad\TraitSeguridad;

class Item extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'Id';
    protected $fillable = ['Nombre' ,'Descripcion'];

    public function __construct()
    {
        parent::__construct();
    }

    public function insumos()
    {
        return $this->hasMany('App\Modelos\Insumo', 'Id_Item');
    }

    public function proveedores()
    {
        return $this->hasMany('App\Modelos\Proveedor', 'Id_Item');
    }

    public function getCode()
    {
        return str_pad($this->Id, 4, '0', STR_PAD_LEFT);
    }

    use TraitSeguridad;
}
