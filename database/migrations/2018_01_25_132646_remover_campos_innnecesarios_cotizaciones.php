<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoverCamposInnnecesariosCotizaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Cotizaciones', function($table)
        {
            $table->dropColumn('Precio');
            $table->dropColumn('Fecha_Actualizacion');
            $table->dropColumn('Observaciones');
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
            $table->integer('Precio')->unsigned()->after('Id_Proveedor');
            $table->date('Fecha_Actualizacion')->after('Precio');
            $table->text('Observaciones')->nullable()->after('Fecha_Actualizacion');
        });
    }
}
