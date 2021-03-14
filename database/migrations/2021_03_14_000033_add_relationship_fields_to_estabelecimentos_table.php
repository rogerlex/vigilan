<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEstabelecimentosTable extends Migration
{
    public function up()
    {
        Schema::table('estabelecimentos', function (Blueprint $table) {
            $table->unsignedBigInteger('bairro_id');
            $table->foreign('bairro_id', 'bairro_fk_3427319')->references('id')->on('bairros');
        });
    }
}
