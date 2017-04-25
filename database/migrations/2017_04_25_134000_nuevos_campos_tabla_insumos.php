<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NuevosCamposTablaInsumos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Insumos', function($table)
        {
            $table->integer('Precio')->unsigned();
            $table->enum('Grupo', ['Materiales', 'Maquinaria', 'Mano de obra', 'Transporte']);
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
            $table->dropColumn('Precio');
            $table->dropColumn('Grupo');
        });
    }
}
