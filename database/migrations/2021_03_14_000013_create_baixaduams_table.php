<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaixaduamsTable extends Migration
{
    public function up()
    {
        Schema::create('baixaduams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_duam');
            $table->date('data_emissao');
            $table->date('data_pagamento');
            $table->float('valorpago', 6, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
