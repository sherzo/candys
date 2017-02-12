<?php

use Illuminate\Database\Seeder;

class PrestacionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('prestaciones')->insert(array (
          'acumulado'     => 0,
      ));
    }
}
