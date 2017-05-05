<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CamposParaFotosInsumos extends Migration
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
            $table->string('Foto_1')->nullable()->after('Precio_Oficial_Calculo');
            $table->string('Foto_2')->nullable()->after('Foto_1');
            $table->string('Foto_3')->nullable()->after('Foto_2');
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
            $table->dropColumn('Foto_1');
            $table->dropColumn('Foto_2');
            $table->dropColumn('Foto_3');
        });
    }
}
