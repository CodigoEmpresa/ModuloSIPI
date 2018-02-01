<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaPreciosOficiales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Insumos', function($table) {
            $table->dropColumn('Precio_Oficial');
            $table->dropColumn('Precio_Oficial_Fecha');
            $table->dropColumn('Precio_Oficial_Calculo');

            $table->boolean('Precio_Oficial_Bloqueado')->default(0)->after('Precio_Adjudicado');
        });

        Schema::create('Precios_Oficiales', function($table) {
            $table->increments('Id');
            $table->integer('Id_Insumo')->unsigned();
            $table->integer('Persona_Id')->unsigned();
            $table->integer('Precio_Oficial')->nullable();
            $table->date('Precio_Oficial_Fecha')->nullable();
            $table->text('Precio_Oficial_Calculo')->nullable();
            $table->boolean('IVA')->default(0);
            $table->timestamps();

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
        Schema::table('Precios_Oficiales', function($table) {
            $table->dropForeign(['Id_Insumo']);
        });

        Schema::drop('Precios_Oficiales');

        Schema::table('Insumos', function($table) {
            $table->dropColumn('Precio_Oficial_Bloqueado');

            $table->integer('Precio_Oficial')->nullable()->after('Unidad_De_Medida');
            $table->date('Precio_Oficial_Fecha')->nullable()->after('Precio_Adjudicado');
            $table->text('Precio_Oficial_Calculo')->nullable()->after('Precio_Oficial_Fecha');
        });
    }
}
