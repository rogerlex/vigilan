<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDenunciacategoriumDenunciumPivotTable extends Migration
{
    public function up()
    {
        Schema::create('denunciacategorium_denuncium', function (Blueprint $table) {
            $table->unsignedBigInteger('denuncium_id');
            $table->foreign('denuncium_id', 'denuncium_id_fk_3416202')->references('id')->on('denuncia')->onDelete('cascade');
            $table->unsignedBigInteger('denunciacategorium_id');
            $table->foreign('denunciacategorium_id', 'denunciacategorium_id_fk_3416202')->references('id')->on('denunciacategoria')->onDelete('cascade');
        });
    }
}
