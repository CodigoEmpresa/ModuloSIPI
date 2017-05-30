<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CamposDetallesAlcancesFichaTecnicas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Fichas_Tecnicas', function($table)
        {
            $table->string('Detalle_Alcance1')->nullable()->after('Alcance1');
            $table->string('Detalle_Alcance2')->nullable()->after('Alcance2');
            $table->string('Detalle_Alcance3')->nullable()->after('Alcance3');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Fichas_Tecnicas', function($table)
        {
            $table->dropColumn('Detalle_Alcance1');
            $table->dropColumn('Detalle_Alcance2');
            $table->dropColumn('Detalle_Alcance3');
        });
    }
}
