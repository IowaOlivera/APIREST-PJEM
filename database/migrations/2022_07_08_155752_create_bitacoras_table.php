<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBitacorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblbitacoras', function (Blueprint $table) {
            $table->id('idBitacora');
            $table->foreignId('idUsuario');//->references('tblusuarios')->on('idUsuario');
            $table->foreignId('cveAccion', '2');//->references('tblacciones')->on('cveAccion');
            $table->dateTime('fechaMovimiento')->useCurrent();
            $table->timestamp('fechaActualizacion')->useCurrent()->useCurrentOnUpdate();
            $table->mediumText('observaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblbitacoras');
    }
}
