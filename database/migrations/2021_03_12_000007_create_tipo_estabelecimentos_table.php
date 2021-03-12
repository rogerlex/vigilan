<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoEstabelecimentosTable extends Migration
{
    public function up()
    {
        Schema::create('tipo_estabelecimentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('categoriaestabelecimento')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
