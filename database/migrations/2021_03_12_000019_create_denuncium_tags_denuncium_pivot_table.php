<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDenunciumTagsDenunciumPivotTable extends Migration
{
    public function up()
    {
        Schema::create('denuncium_tags_denuncium', function (Blueprint $table) {
            $table->unsignedBigInteger('denuncium_id');
            $table->foreign('denuncium_id', 'denuncium_id_fk_3416203')->references('id')->on('denuncia')->onDelete('cascade');
            $table->unsignedBigInteger('tags_denuncium_id');
            $table->foreign('tags_denuncium_id', 'tags_denuncium_id_fk_3416203')->references('id')->on('tags_denuncia')->onDelete('cascade');
        });
    }
}
