<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColaboradoreVisitumPivotTable extends Migration
{
    public function up()
    {
        Schema::create('colaboradore_visitum', function (Blueprint $table) {
            $table->unsignedBigInteger('visitum_id');
            $table->foreign('visitum_id', 'visitum_id_fk_3428942')->references('id')->on('visita')->onDelete('cascade');
            $table->unsignedBigInteger('colaboradore_id');
            $table->foreign('colaboradore_id', 'colaboradore_id_fk_3428942')->references('id')->on('colaboradores')->onDelete('cascade');
        });
    }
}
