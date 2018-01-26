<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelacionDeProveedoresConItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Proveedores', function($table)
        {
            $table->integer('Id_Item')->nullable()->unsigned()->after('Id');

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
        Schema::table('Proveedores', function($table)
        {
            $table->dropForeign(['Id_Item']);

            $table->dropColumn('Id_Item');
        });
    }
}
