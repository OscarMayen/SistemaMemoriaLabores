<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividad', function (Blueprint $table) {
            $table->id();
            $table->string('nomActividad',100);
            $table->date('fechaActividad');
            $table->timestamps();
            $table->foreignId('memoria_id')
                ->references('id')
                ->on('memoria')
                ->onDelete('cascade');
            $table->foreignId('tipoActividad_id')
                ->references('id')
                ->on('tipo_actividad')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividads');
    }
}
