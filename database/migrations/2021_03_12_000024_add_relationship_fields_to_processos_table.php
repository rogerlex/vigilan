<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProcessosTable extends Migration
{
    public function up()
    {
        Schema::table('processos', function (Blueprint $table) {
            $table->unsignedBigInteger('tipoestabelecimento_id');
            $table->foreign('tipoestabelecimento_id', 'tipoestabelecimento_fk_3416260')->references('id')->on('tipo_estabelecimentos');
            $table->unsignedBigInteger('tipoprocesso_id')->nullable();
            $table->foreign('tipoprocesso_id', 'tipoprocesso_fk_3416261')->references('id')->on('tipo_processos');
        });
    }
}
