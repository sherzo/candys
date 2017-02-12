<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGastoExtraRecibo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gasto_extra_recibo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gasto_extra_id')->unsigned();
            $table->foreign('gasto_extra_id')->references('id')->on('gastos_extra')->onDelete('Cascade');
            $table->integer('recibo_id')->unsigned();
            $table->foreign('recibo_id')->references('id')->on('recibos')->onDelete('Cascade');
            $table->float('importe');
            $table->boolean('estatus')->default(true);
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
        Schema::drop('gasto_extra_recibo');
    }
}
