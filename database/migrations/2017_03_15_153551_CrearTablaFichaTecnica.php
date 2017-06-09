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
        Schema::create('Fichas_Tecnicas', function (Blueprint $table) {

            $table->increments('Id');
            $table->integer('Subdireccion_Id')->unsigned();
            $table->integer('Persona_Id')->unsigned();
            $table->integer('Administrador_Id')->unsigned();
            $table->string('Anio');
            $table->string('Codigo_Proceso');
            $table->string('Objeto', 1500);
            $table->string('Presupuesto_Estimado');
            $table->date('Fecha_Entrega_Estimada');
            $table->date('Fecha_De_Llegada')->nullable();
            $table->time('Hora_De_Llegada')->nullable();
            $table->string('Observacion', 1500);
            $table->date('Alcance1')->nullable();
            $table->date('Alcance2')->nullable();
            $table->date('Alcance3')->nullable();
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
        Schema::table('Fichas_Tecnicas', function(Blueprint $table){
            $table->dropForeign(['Subdireccion_Id']);
        });

        Schema::drop('Fichas_Tecnicas');
    }
}
