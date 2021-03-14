<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColaboradoreDepartamentoPivotTable extends Migration
{
    public function up()
    {
        Schema::create('colaboradore_departamento', function (Blueprint $table) {
            $table->unsignedBigInteger('colaboradore_id');
            $table->foreign('colaboradore_id', 'colaboradore_id_fk_3432205')->references('id')->on('colaboradores')->onDelete('cascade');
            $table->unsignedBigInteger('departamento_id');
            $table->foreign('departamento_id', 'departamento_id_fk_3432205')->references('id')->on('departamentos')->onDelete('cascade');
        });
    }
}
