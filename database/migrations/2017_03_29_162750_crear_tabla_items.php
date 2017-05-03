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
            $table->string('Nombre', 100);
            $table->text('Descripcion')->nullable();
            $table->timestamps();
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
