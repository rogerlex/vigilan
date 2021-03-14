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
            $table->date('inicio_processo');
            $table->date('final_processo')->nullable();
            $table->string('solicitante');
            $table->string('email')->nullable();
            $table->longText('descricao');
            $table->string('numero_do_processo');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
