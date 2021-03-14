<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendenciaTable extends Migration
{
    public function up()
    {
        Schema::create('pendencia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('pendencia');
            $table->date('prazo');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
