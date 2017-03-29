<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Items', function($table)
        {
            $table->increments('Id');
            $table->string('Codigo', 50);
            $table->string('Nombre', 100);
            $table->text('Descripcion')->nullable();
            $table->text('Unidad_De_Medida')->nullable();
            $table->timestamps();
        });

        Schema::create('Fichas_Tecnicas_Items', function($table)
        {
            $table->integer('Id_Ficha')->unsigned();
            $table->integer('Id_Item')->unsigned();
            $table->integer('Cantidad')->unsigned()->default(0);

            $table->foreign('Id_Ficha')->references('Id')->on('ficha_tecnica');
            $table->foreign('Id_Item')->references('Id')->on('Items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Fichas_Tecnicas_Items', function($table)
        {
            $table->dropForeign(['Id_Ficha']);
            $table->dropForeign(['Id_Item']);
        });

        Schema::drop('Fichas_Tecnicas_Items');
        Schema::drop('Items');
    }
}
