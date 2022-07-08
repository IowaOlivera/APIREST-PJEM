<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblrespuestas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cvePregunta');//->references('tblpreguntas')->on('cvePregunta');
            $table->string('desRespuesta', 500);
            $table->char('correcta', 1);
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
        Schema::dropIfExists('tblrespuestas');
    }
}
