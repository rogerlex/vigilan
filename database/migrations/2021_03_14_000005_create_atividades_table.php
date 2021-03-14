<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtividadesTable extends Migration
{
    public function up()
    {
        Schema::create('atividades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('relatorio_da_atividade');
            $table->date('data_atividade');
            $table->string('vista_num_processo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
