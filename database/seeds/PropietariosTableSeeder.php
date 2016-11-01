<?php

use Illuminate\Database\Seeder;

class PropietariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	//Nombre y apellido de los propietarios
    	$propietarios = array('1' => 'Josefina Tejada', 								  '2' => 'Tomas Padrino', 
    						  '3' => 'Yrluismar Pino',
    						  '4' => 'Ana Ribas',
    						  '5' => 'Maria Morales', 
    						  '6' => 'Aracelis Boada',
    						  '7' => 'Felix Yepez', 
    						  '8' => 'Enzo Mazzacappa',
    						  '9' => 'Carmen Diaz',
    						  '10' => 'Xiomara Mora',
    						  '11' => 'Jorge Ruiz', 
    						  '12' => 'Carmen Ramos', 
    						  '13' => 'Alicia Ortiz',
    						  '14' => 'Carmen Arevalo',
    						  '15' => 'Juan Correira',
    						  '16' => 'Luis Chacon', 
    						  '17' => 'Carlos Perez',
    						  '18' => 'Martin Mora',
    						  '19' => 'Estela Ayala', 
    						  '20' => 'Ramon Gonzalez',
    						  '21' => 'Carmen Peralta', 
    						  '22' => 'Jenniffer Pardo',
    						  '23' => 'Geisa Rodriguez',
    						  '24' => 'Tabata Moreno',
    						  '25' => 'Esmeralda Gamez',
    						  '26' => 'Jose Contreras',
    						  '27' => 'Nancy Ruiz',
    						  '28' => 'Santiago Gonzalez', 
    						  '29' => 'Alejandro Rojas', 
    						  '30' => 'Fanny Flores',
    						  '31' => 'Rafael Hernandez',
    						  '32' => 'Carolina Sequera',
    						  '33' => 'Marcos Sandoval',
    						  '34' => 'Pedro Yanez',
    						  '35' => 'Jesus Molina',
    						  '36' => 'Oswaldo Monsalve',
    						  '37' => 'Gladys Ortega',
    						  '38' => 'Carmen Novoa',
    						  '39' => 'Feng Haiqiang',
    						  '40' => 'Janina Garcer',
    						  '41' => 'Jose Ochoa',
    						  '42' => 'Juan Marco',
    						  '43' => 'Amilcar Molina',
    						  '44' => 'Patricia Ayala');

    	for ($i=1; $i <=44; $i++) { 

    		// Extraigo nombre y apellido del array
    		list($nombre, $apellido) = explode(" ", $propietarios[$i]);
    		
    		\DB::table('propietarios')->insert(array (
	            'nombre' => $nombre,
	            'apellido' => $apellido, 
        	));

    		\DB::table('propietario_apartamento')->insert(array (
	            'propietario_id' => $i,
	            'apartamento_id' => $i, 
        	));

    	}
        
    }
}
