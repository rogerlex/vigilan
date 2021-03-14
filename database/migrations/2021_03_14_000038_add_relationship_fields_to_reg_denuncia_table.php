<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRegDenunciaTable extends Migration
{
    public function up()
    {
        Schema::table('reg_denuncia', function (Blueprint $table) {
            $table->unsignedBigInteger('origem_id');
            $table->foreign('origem_id', 'origem_fk_3426674')->references('id')->on('tags');
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id', 'categoria_fk_3426675')->references('id')->on('categoria');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id', 'status_fk_3426704')->references('id')->on('statuses');
        });
    }
}
