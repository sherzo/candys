<?php

use Illuminate\Database\Seeder;

class GastosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('gastos')->insert(array (
            'gasto'     => 'Hidrocentro',
        ));

        \DB::table('gastos')->insert(array (
            'gasto'     => 'Elecentro',
        ));

        \DB::table('gastos')->insert(array (
            'gasto'     => 'PDV Comunal',
        ));

        \DB::table('gastos')->insert(array (
            'gasto'     => 'Consumo portón electrico principal',
        ));

        \DB::table('gastos')->insert(array (
            'gasto'     => 'Salario  trabajador residendial',
        ));

        \DB::table('gastos')->insert(array (
            'gasto'     => 'S.S.O trabajador residendial',
        ));

        \DB::table('gastos')->insert(array (
            'gasto'     => 'F.A.O.V trabajador residendial',
        ));

        \DB::table('gastos')->insert(array (
            'gasto'     => 'Bono de alimentación trabajador residendial',
        ));

        \DB::table('gastos')->insert(array (
            'gasto'     => 'Apartado de prestaciones trabajador residencial',
        ));

        \DB::table('gastos')->insert(array (
            'gasto'     => 'Artículos de limpieza',
        ));

        \DB::table('gastos')->insert(array (
            'gasto'     => 'Bolsas negras',
        ));

        \DB::table('gastos')->insert(array (
            'gasto'     => 'Artículos eléctricos',
        ));

        \DB::table('gastos')->insert(array (
            'gasto'     => 'Gastos de administración',
        ));

        \DB::table('gastos')->insert(array (
            'gasto'     => 'Elaboración del recibo',
        ));

        \DB::table('gastos')->insert(array (
            'gasto'     => 'Mantenimiento del ascensor',
        ));

        \DB::table('gastos')->insert(array (
            'gasto'     => 'Mantenimiento de los jardines',
        ));

        \DB::table('gastos')->insert(array (
            'gasto'     => 'Mantenimiento del portón',
        ));
    }
}
