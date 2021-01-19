<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // se agrupan todas las migraciones que esten relacionadas en el misma migracion, porque tiene fk y laravel tiende a ejecutar las migraciones por ordern de creacion lo cual impide crear cada migracion ya que no se puede crear una tabla con fk sin antes haber creado la tabla principal Pk
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('experiencias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('ubicacions', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('salarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('vacantes', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion');
            // elimina la llave FK y el registro primario
            $table->foreignId('categoria_id')->references('id')->on('categorias')->onDelete('cascade');

            $table->foreignId('experiencia_id')->references('id')->on('experiencias')->onDelete('cascade');

            $table->foreignId('ubicacion_id')->references('id')->on('ubicacions')->onDelete('cascade');

            $table->foreignId('salario_id')->references('id')->on('salarios')->onDelete('cascade');

            $table->foreignId('skill_id')->references('id')->on('skills')->onDelete('cascade');

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
        // primero se elimina las fk y luego la tabla principal
        Schema::dropIfExists('vacantes');
        Schema::dropIfExists('experienciass');
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('ubicacions');
        Schema::dropIfExists('salarios');
        Schema::dropIfExists('skills');
    }
}
