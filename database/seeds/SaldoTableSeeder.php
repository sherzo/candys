<?php

use Illuminate\Database\Seeder;

class SaldoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('saldo')->insert(array (
			'saldo' => 0,
		  ));
    }
}
