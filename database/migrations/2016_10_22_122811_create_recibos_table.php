<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecibosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mes');
            $table->string('anio');
            $table->string('subtotal');
            $table->string('fondo');
            $table->string('porcentaje')->default('');
            $table->string('operacion');
            $table->string('total');
            $table->string('subcuota')->default(0);
            $table->string('cuota_fondo')->default(0);
            $table->string('cuota');
            $table->text('observaciones');
            $table->boolean('editar')->default(true);
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
        Schema::drop('recibos');
    }
}
