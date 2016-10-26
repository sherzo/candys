<?php

use Illuminate\Database\Seeder;

class ApartamentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	for ($i=0; $i <=10 ; $i++) { 
    	
    		for ($j=1; $j <=4 ; $j++) { 

    			if($i == 0){
    				// Apartamentos de Planta Baja
    				\DB::table('apartamentos')->insert(array (
			                'numero' => 'PB-0'.$j,
			        ));

    			}else if($i < 10){	
    				//Apartamentos con 0 adelante
			        \DB::table('apartamentos')->insert(array (
			                'numero' => '0'.$i.'-0'.$j,
			        ));

	     		}else{
	     			//Apartamentos piso 10
			        \DB::table('apartamentos')->insert(array (
			                'numero' => $i.'-0'.$j,
			        ));

        		}
	    	}
    	}
    }
}
