<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstabelecimentoProcessoPivotTable extends Migration
{
    public function up()
    {
        Schema::create('estabelecimento_processo', function (Blueprint $table) {
            $table->unsignedBigInteger('processo_id');
            $table->foreign('processo_id', 'processo_id_fk_3427811')->references('id')->on('processos')->onDelete('cascade');
            $table->unsignedBigInteger('estabelecimento_id');
            $table->foreign('estabelecimento_id', 'estabelecimento_id_fk_3427811')->references('id')->on('estabelecimentos')->onDelete('cascade');
        });
    }
}
