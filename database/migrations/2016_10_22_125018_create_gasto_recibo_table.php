<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGastoReciboTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gasto_recibo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gasto_id')->unsigned();
            $table->foreign('gasto_id')->references('id')->on('gastos')->onDelete('Cascade');
            $table->integer('recibo_id')->unsigned();
            $table->foreign('recibo_id')->references('id')->on('recibos')->onDelete('Cascade');
            $table->string('importe');
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
        Schema::drop('gasto_recibo');
    }
}
