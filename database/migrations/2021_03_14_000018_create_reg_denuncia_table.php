<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegDenunciaTable extends Migration
{
    public function up()
    {
        Schema::create('reg_denuncia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('data_denuncia');
            $table->string('denunciante')->nullable();
            $table->string('contato')->nullable();
            $table->longText('descricao');
            $table->longText('feedback')->nullable();
            $table->timestamps();
        });
    }
}
