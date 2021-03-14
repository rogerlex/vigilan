<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBairrosTable extends Migration
{
    public function up()
    {
        Schema::create('bairros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bairro')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
