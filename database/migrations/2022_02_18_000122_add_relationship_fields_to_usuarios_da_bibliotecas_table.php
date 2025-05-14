<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUsuariosDaBibliotecasTable extends Migration
{
    public function up()
    {
        Schema::table('usuarios_da_bibliotecas', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_6026789')->references('id')->on('teams');
            $table->unsignedBigInteger('assinatura_id')->nullable();
            $table->foreign('assinatura_id', 'assinatura_fk_6026790')->references('id')->on('users');
        });
    }
}
