<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessosTable extends Migration
{
    public function up()
    {
        Schema::create('processos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('inicio');
            $table->date('fim')->nullable();
            $table->string('solicitante');
            $table->string('emailprocesso')->nullable();
            $table->longText('descricao')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
