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
            $table->integer('Id_Item')->unsigned();
            $table->integer('Id_Proveedor')->unsigned();
            $table->boolean('Precio_Oficial')->default(0);
            $table->integer('Precio')->unsigned();
            $table->string('Precio_Calculo')->nullable();
            $table->date('Fecha_Actualizacion');
            $table->timestamps();

            $table->foreign('Id_Item')->references('Id')->on('Items');
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
            $table->dropForeign(['Id_Item']);
            $table->dropForeign(['Id_Proveedor']);
        });

        Schema::drop('Cotizaciones');
        Schema::drop('Proveedores');
    }
}
