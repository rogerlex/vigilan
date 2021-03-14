<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtividadeColaboradorePivotTable extends Migration
{
    public function up()
    {
        Schema::create('atividade_colaboradore', function (Blueprint $table) {
            $table->unsignedBigInteger('atividade_id');
            $table->foreign('atividade_id', 'atividade_id_fk_3428050')->references('id')->on('atividades')->onDelete('cascade');
            $table->unsignedBigInteger('colaboradore_id');
            $table->foreign('colaboradore_id', 'colaboradore_id_fk_3428050')->references('id')->on('colaboradores')->onDelete('cascade');
        });
    }
}
