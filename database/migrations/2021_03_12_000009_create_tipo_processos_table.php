<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoProcessosTable extends Migration
{
    public function up()
    {
        Schema::create('tipo_processos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipoprocesso')->unique();
            $table->string('descricaotipoprocesso')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
