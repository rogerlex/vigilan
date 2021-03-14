<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToVisitaTable extends Migration
{
    public function up()
    {
        Schema::table('visita', function (Blueprint $table) {
            $table->unsignedBigInteger('status_visita_id');
            $table->foreign('status_visita_id', 'status_visita_fk_3428947')->references('id')->on('statuses');
        });
    }
}
