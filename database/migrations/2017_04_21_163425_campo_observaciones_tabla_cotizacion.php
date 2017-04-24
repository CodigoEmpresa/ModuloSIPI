<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CampoObservacionesTablaCotizacion extends Migration
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
            $table->text('Observaciones')->nullable()->after('Fecha_Actualizacion');
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
            $table->dropColumn('Observaciones');
        });
    }
}
