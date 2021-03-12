<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstabelecimentosTable extends Migration
{
    public function up()
    {
        Schema::create('estabelecimentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cnpj')->unique();
            $table->string('razaosocial');
            $table->string('nomefantasia')->nullable();
            $table->string('natureza')->nullable();
            $table->string('tipo')->nullable();
            $table->float('area', 7, 2)->nullable();
            $table->string('atvprincipal')->nullable();
            $table->string('atvsecundaria')->nullable();
            $table->string('logradouro')->nullable();
            $table->string('numero')->nullable();
            $table->string('referencia')->nullable();
            $table->string('uf')->nullable();
            $table->string('municipio')->nullable();
            $table->string('responsavel')->nullable();
            $table->string('foneresponsavel')->nullable();
            $table->string('cpfresponsavel')->nullable();
            $table->string('wattsapp')->nullable();
            $table->string('email')->nullable();
            $table->string('situacao')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
