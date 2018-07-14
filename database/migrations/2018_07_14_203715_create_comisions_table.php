<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comisions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_departamento');
            $table->unsignedInteger('id_facultad');
            $table->unsignedInteger('id_rol');
            $table->unsignedInteger('id_user');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_departamento')
                ->references('id')
                ->on('departamentos')
                ->onDelete('cascade');;
            $table->foreign('id_facultad')
                ->references('id')
                ->on('facultads')
                ->onDelete('cascade');;
            $table->foreign('id_rol')
                ->references('id')
                ->on('rols')
                ->onDelete('cascade');;
            $table->foreign('id_user')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('comisions');
    }
}
