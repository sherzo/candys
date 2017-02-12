<?php

use Illuminate\Database\Seeder;

class FondoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('fondo')->insert(array (
			'reserva' => '0',
			'real' => '0',
		  ));
    }
}
