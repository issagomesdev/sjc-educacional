<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmprestimosEDevolucosTable extends Migration
{
    public function up()
    {
        Schema::create('emprestimos_e_devolucos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('prazo')->nullable();
            $table->string('data_de_devolucao')->nullable();
            $table->string('situacao')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
