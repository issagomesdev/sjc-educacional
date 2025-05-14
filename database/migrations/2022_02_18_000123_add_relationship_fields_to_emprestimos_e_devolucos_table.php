<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEmprestimosEDevolucosTable extends Migration
{
    public function up()
    {
        Schema::table('emprestimos_e_devolucos', function (Blueprint $table) {
            $table->unsignedBigInteger('usuario_da_biblioteca_id')->nullable();
            $table->foreign('usuario_da_biblioteca_id', 'usuario_da_biblioteca_fk_6027562')->references('id')->on('usuarios_da_bibliotecas');
            $table->unsignedBigInteger('biblioteca_id')->nullable();
            $table->foreign('biblioteca_id', 'biblioteca_fk_6027563')->references('id')->on('cadastrar_bibliotecas');
            $table->unsignedBigInteger('assinatura_id')->nullable();
            $table->foreign('assinatura_id', 'assinatura_fk_6027568')->references('id')->on('users');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_6027569')->references('id')->on('teams');
        });
    }
}
