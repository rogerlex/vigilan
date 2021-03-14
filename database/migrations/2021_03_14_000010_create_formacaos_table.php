<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormacaosTable extends Migration
{
    public function up()
    {
        Schema::create('formacaos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('formacao')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
