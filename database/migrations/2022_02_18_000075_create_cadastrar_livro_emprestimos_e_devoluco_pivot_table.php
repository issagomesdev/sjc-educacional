<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadastrarLivroEmprestimosEDevolucoPivotTable extends Migration
{
    public function up()
    {
        Schema::create('cadastrar_livro_emprestimos_e_devoluco', function (Blueprint $table) {
            $table->unsignedBigInteger('emprestimos_e_devoluco_id');
            $table->foreign('emprestimos_e_devoluco_id', 'emprestimos_e_devoluco_id_fk_6027564')->references('id')->on('emprestimos_e_devolucos')->onDelete('cascade');
            $table->unsignedBigInteger('cadastrar_livro_id');
            $table->foreign('cadastrar_livro_id', 'cadastrar_livro_id_fk_6027564')->references('id')->on('cadastrar_livros')->onDelete('cascade');
        });
    }
}
