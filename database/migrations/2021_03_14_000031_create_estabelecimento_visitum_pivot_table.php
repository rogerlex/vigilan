<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstabelecimentoVisitumPivotTable extends Migration
{
    public function up()
    {
        Schema::create('estabelecimento_visitum', function (Blueprint $table) {
            $table->unsignedBigInteger('visitum_id');
            $table->foreign('visitum_id', 'visitum_id_fk_3428940')->references('id')->on('visita')->onDelete('cascade');
            $table->unsignedBigInteger('estabelecimento_id');
            $table->foreign('estabelecimento_id', 'estabelecimento_id_fk_3428940')->references('id')->on('estabelecimentos')->onDelete('cascade');
        });
    }
}
