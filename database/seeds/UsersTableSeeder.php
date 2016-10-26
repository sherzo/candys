<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert(array (
            'name'     => 'Blanca Chacon',
            'user'     => 'admin',
            'password' => \Hash::make('admin'),
        ));

        \DB::table('users')->insert(array (
            'name'     => 'Saul Florez',
            'user'     => 'root',
            'password' => \Hash::make('root'),
        ));
    }
}
