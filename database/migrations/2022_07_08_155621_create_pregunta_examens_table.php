<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreguntaExamensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblexamenespreguntas', function (Blueprint $table) {
            $table->id('idExamenPregunta');
            $table->foreignId('idExamen');//->references('tblExamenes')->on('idExamen');
            $table->foreignId('cvePregunta');//->references('tblpreguntas')->on('cvePregunta');
            $table->char('activo', 1);
            $table->timestamp('fechaRegistro')->useCurrent();
            $table->timestamp('fechaActualizacion')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblexamenespreguntas');
    }
}
