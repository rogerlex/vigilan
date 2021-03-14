<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAtividadesTable extends Migration
{
    public function up()
    {
        Schema::table('atividades', function (Blueprint $table) {
            $table->unsignedBigInteger('numeroprocesso_id');
            $table->foreign('numeroprocesso_id', 'numeroprocesso_fk_3428047')->references('id')->on('processos');
            $table->unsignedBigInteger('tipo_de_processo_id');
            $table->foreign('tipo_de_processo_id', 'tipo_de_processo_fk_3428048')->references('id')->on('tipos_processos');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id', 'status_fk_3428051')->references('id')->on('statuses');
        });
    }
}
