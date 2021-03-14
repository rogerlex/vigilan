<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitaTable extends Migration
{
    public function up()
    {
        Schema::create('visita', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('motivo');
            $table->date('dataagendamento');
            $table->longText('relatorio_observado')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
