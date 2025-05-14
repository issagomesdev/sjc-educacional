<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosDaBibliotecasTable extends Migration
{
    public function up()
    {
        Schema::create('usuarios_da_bibliotecas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome_completo')->nullable();
            $table->date('data_de_nascimento')->nullable();
            $table->string('genero')->nullable();
            $table->string('nacionalidade')->nullable();
            $table->string('localizacao')->nullable();
            $table->string('estado')->nullable();
            $table->string('cidade')->nullable();
            $table->string('bairro')->nullable();
            $table->string('endereco')->nullable();
            $table->string('e_mail_de_contato')->nullable();
            $table->string('numero_do_cpf')->nullable();
            $table->string('numero_da_identidade')->nullable();
            $table->string('numero_de_telefone')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
