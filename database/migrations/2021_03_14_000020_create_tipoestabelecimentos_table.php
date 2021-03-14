<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoestabelecimentosTable extends Migration
{
    public function up()
    {
        Schema::create('tipoestabelecimentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipoestabelecimento')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
