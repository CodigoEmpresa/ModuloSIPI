<?php

use Illuminate\Database\Seeder;

class Subdireccion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
    {
        DB::table('subdireccion')->delete();        
        DB::table('subdireccion')->insert([
            ['Nombre_Subdireccion' => 'STRD'],
            ['Nombre_Subdireccion' => 'STC'],
            ['Nombre_Subdireccion' => 'STP'],
            ['Nombre_Subdireccion' => 'SAF'],
            ['Nombre_Subdireccion' => 'SG'],
            ]);
    }
}