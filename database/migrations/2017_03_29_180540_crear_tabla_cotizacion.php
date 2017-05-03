<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCotizacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Proveedores', function($table)
        {
            $table->increments('Id');
            $table->string('Nombre');
            $table->string('Ciudad');
            $table->string('Direccion');
            $table->string('Telefono');
            $table->string('Email');
            $table->string('Nombre_Contacto');
            $table->timestamps();
        });

        Schema::create('Cotizaciones', function($table)
        {
            $table->increments('Id');
            $table->integer('Id_Insumo')->unsigned();
            $table->integer('Id_Proveedor')->unsigned();
            $table->integer('Precio')->unsigned();
            $table->date('Fecha_Actualizacion');
            $table->timestamps();

            $table->foreign('Id_Insumo')->references('Id')->on('Insumos');
            $table->foreign('Id_Proveedor')->references('Id')->on('Proveedores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Cotizaciones', function($table)
        {
            $table->dropForeign(['Id_Insumo']);
            $table->dropForeign(['Id_Proveedor']);
        });

        Schema::drop('Cotizaciones');
        Schema::drop('Proveedores');
    }
}
