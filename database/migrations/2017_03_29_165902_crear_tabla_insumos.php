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
            $table->string('Codigo', 50);
            $table->string('Nombre', 100);
            $table->text('Descripcion')->nullable();
            $table->text('Unidad_De_Medida')->nullable();
            $table->timestamps();
        });

        Schema::create('Items_Insumos', function($table)
        {
            $table->integer('Id_Item')->unsigned();
            $table->integer('Id_Insumo')->unsigned();
            $table->integer('Cantidad')->unsigned()->default(0);

            $table->foreign('Id_Item')->references('Id')->on('Items');
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
        Schema::table('Items_Insumos', function($table)
        {
            $table->dropForeign(['Id_Item']);
            $table->dropForeign(['Id_Insumo']);
        });

        Schema::drop('Items_Insumos');
        Schema::drop('Insumos');
    }
}
