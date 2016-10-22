<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropietarioApartamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propiertario_apartamento', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('propietario_id')->unsigned();
            $table->foreign('propietario_id')->references('id')->on('propietarios')->onDelete('Cascade');
            $table->integer('apartamento_id')->unsigned();
            $table->foreign('apartamento_id')->references('id')->on('apartamentos')->onDelete('Cascade');
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
        Schema::drop('propiertario_apartamento');
    }
}
