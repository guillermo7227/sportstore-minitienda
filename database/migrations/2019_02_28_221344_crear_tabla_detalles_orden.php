<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaDetallesOrden extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_orden', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('orden_id')->unsigned();
            $table->bigInteger('producto_id')->unsigned();
            $table->string('nombre');
            $table->text('descripcion');
            $table->text('categoria');
            $table->double('precio');
            $table->integer('cantidad')->unsigned();
            $table->double('total_linea');
            $table->timestamps();

            $table->foreign('orden_id')->references('id')->on('ordenes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalles_orden');
    }
}
