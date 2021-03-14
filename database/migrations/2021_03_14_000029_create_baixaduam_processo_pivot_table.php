<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaixaduamProcessoPivotTable extends Migration
{
    public function up()
    {
        Schema::create('baixaduam_processo', function (Blueprint $table) {
            $table->unsignedBigInteger('baixaduam_id');
            $table->foreign('baixaduam_id', 'baixaduam_id_fk_3429259')->references('id')->on('baixaduams')->onDelete('cascade');
            $table->unsignedBigInteger('processo_id');
            $table->foreign('processo_id', 'processo_id_fk_3429259')->references('id')->on('processos')->onDelete('cascade');
        });
    }
}
