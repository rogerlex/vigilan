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
            $table->string('nomefantasia');
            $table->string('natureza_do_estabelecimento');
            $table->string('tipo')->nullable();
            $table->float('area', 7, 2)->nullable();
            $table->string('atividade_principal');
            $table->longText('atividade_secundaria')->nullable();
            $table->string('logradouro');
            $table->string('numero')->nullable();
            $table->string('ponto_de_referencia')->nullable();
            $table->string('municipio');
            $table->string('uf');
            $table->string('responsavel_tecnico')->nullable();
            $table->string('cpf')->nullable();
            $table->string('contato')->nullable();
            $table->string('email')->nullable();
            $table->string('situacao');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
