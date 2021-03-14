<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdentidadegenerosTable extends Migration
{
    public function up()
    {
        Schema::create('identidadegeneros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('genero')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
