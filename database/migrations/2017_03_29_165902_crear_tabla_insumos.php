<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaInsumos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Insumos', function($table)
        {
            $table->increments('Id');
            $table->integer('Id_Item')->unsigned();
            $table->string('Nombre', 100);
            $table->text('Descripcion')->nullable();
            $table->text('Unidad_De_Medida')->nullable();
            $table->integer('Precio_Oficial')->nullable();
            $table->integer('Precio_Adjudicado')->nullable();
            $table->text('Precio_Oficial_Calculo')->nullable();
            $table->timestamps();

            $table->foreign('Id_Item')->references('Id')->on('Items');
        });

        Schema::create('Fichas_Tecnicas_Insumos', function($table)
        {
            $table->integer('Id_Ficha')->unsigned();
            $table->integer('Id_Insumo')->unsigned();
            $table->integer('Cantidad')->unsigned()->default(0);

            $table->foreign('Id_Ficha')->references('Id')->on('Fichas_Tecnicas');
            $table->foreign('Id_Insumo')->references('Id')->on('Insumos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Insumos', function($table)
        {
            $table->dropForeign(['Id_Item']);
        });

        Schema::table('Fichas_Tecnicas_Insumos', function($table)
        {
            $table->dropForeign(['Id_Ficha']);
            $table->dropForeign(['Id_Insumo']);
        });

        Schema::drop('Fichas_Tecnicas_Insumos');
        Schema::drop('Insumos');
    }
}
