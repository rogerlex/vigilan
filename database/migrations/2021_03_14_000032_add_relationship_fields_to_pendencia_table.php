<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPendenciaTable extends Migration
{
    public function up()
    {
        Schema::table('pendencia', function (Blueprint $table) {
            $table->unsignedBigInteger('idestabelecimento_id');
            $table->foreign('idestabelecimento_id', 'idestabelecimento_fk_3428950')->references('id')->on('estabelecimentos');
        });
    }
}
