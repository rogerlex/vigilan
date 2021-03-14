<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProcessosTable extends Migration
{
    public function up()
    {
        Schema::table('processos', function (Blueprint $table) {
            $table->unsignedBigInteger('tipoprocesso_id');
            $table->foreign('tipoprocesso_id', 'tipoprocesso_fk_3427084')->references('id')->on('tipos_processos');
            $table->unsignedBigInteger('status_processo_id');
            $table->foreign('status_processo_id', 'status_processo_fk_3434775')->references('id')->on('statuses');
        });
    }
}
