<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_facultad');
            $table->unsignedInteger('id_comision')->nullable();
            $table->string('nombre');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_facultad')
                ->references('id')
                ->on('facultads')
                ->onDelete('cascade');;
            $table->foreign('id_comision')
                ->references('id')
                ->on('comisions')
                ->onDelete('cascade');;

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departamentos');
    }
}
