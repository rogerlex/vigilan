<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDenunciaTable extends Migration
{
    public function up()
    {
        Schema::create('denuncia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('data_denuncia')->nullable();
            $table->string('denunciante')->nullable();
            $table->string('contato_denunciante')->nullable();
            $table->longText('description')->nullable();
            $table->longText('tratativa')->nullable();
            $table->string('status')->nullable();
            $table->date('data_conclusao')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
