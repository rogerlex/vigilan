<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColaboradoresTable extends Migration
{
    public function up()
    {
        Schema::create('colaboradores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome')->unique();
            $table->string('cpf')->unique();
            $table->string('telefone')->nullable();
            $table->string('email')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
