<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposProcessosTable extends Migration
{
    public function up()
    {
        Schema::create('tipos_processos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipoprocesso')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
