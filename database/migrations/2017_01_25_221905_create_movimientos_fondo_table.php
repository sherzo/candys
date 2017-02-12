<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientosFondoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos_fondo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('signo')->default('+');
            $table->text('transaccion');
            $table->float('monto');
            $table->float('saldo_fondo');
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
        Schema::drop('movimientos_fondo');
    }
}
