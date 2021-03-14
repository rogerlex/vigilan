<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToColaboradoresTable extends Migration
{
    public function up()
    {
        Schema::table('colaboradores', function (Blueprint $table) {
            $table->unsignedBigInteger('genero_id');
            $table->foreign('genero_id', 'genero_fk_3427439')->references('id')->on('identidadegeneros');
            $table->unsignedBigInteger('formacao_id');
            $table->foreign('formacao_id', 'formacao_fk_3427442')->references('id')->on('formacaos');
            $table->unsignedBigInteger('cargo_id');
            $table->foreign('cargo_id', 'cargo_fk_3427443')->references('id')->on('cargos');
        });
    }
}
