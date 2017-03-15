<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaFichaTecnica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
       Schema::create('ficha_tecnica', function (Blueprint $table) {

            $table->increments('Id');
            $table->integer('Subdireccion_Id')->unsigned();
            $table->integer('Persona_Id');
            $table->date('Anio');
            $table->integer('Codigo_Proceso');
            $table->string('Objeto', 1500);
            $table->string('Presupuesto_Estimado');
            $table->date('Fecha_Entrega_Estimada');
            $table->string('Observacion', 1500);
            $table->timestamps();

            $table->foreign('Subdireccion_Id')->references('Id')->on('subdireccion');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ficha_tecnica', function(Blueprint $table){
            $table->dropForeign('Contrato_Id');
        });    
        Schema::drop('ficha_tecnica');
    }
}