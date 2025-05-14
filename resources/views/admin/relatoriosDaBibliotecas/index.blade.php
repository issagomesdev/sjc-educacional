@extends('layouts.admin')
<title> Relatórios da Biblioteca </title>
@section('content')

<div class="card">
    <div class="card-header">
        Relatórios da Biblioteca
    </div>
    </div>

<div class="cards-icons">

  <div class="card-icons">
    <div class="card-body">
      <div class="card-icon">
      <a href="{{ route("admin.relatorios-da-bibliotecas.livros") }}">
      <i class="icon fas fa-book-open fa-7x" ></i>
      <div class="lab"> <span> Livros </span> </div>
      </a>
      </div>
    </div>
    </div>


    <div class="card-icons">
      <div class="card-body">
        <div class="card-icon">
        <a href="{{ route("admin.relatorios-da-bibliotecas.users") }}">
        <i class="icon fas fa-user-tag fa-7x" ></i>
        <div class="lab"> <span> Usuários Da Biblioteca </span> </div>
        </a>
        </div>
      </div>
      </div>

      <div class="card-icons">
        <div class="card-body">
          <div class="card-icon">
          <a href="{{ route("admin.relatorios-da-bibliotecas.emprestimos") }}">
          <i class="icon fas fa-handshake fa-7x" ></i>
          <div class="lab"> <span> Empréstimos e Devoluções </span> </div>
          </a>
          </div>
        </div>
        </div>

      </div>

  <link rel="stylesheet" href="{{ url('reports/icons.css') }}">
  <link rel="stylesheet" href="{{ url('reports/response.css') }}">
  <link rel="stylesheet" href="{{ url('css/panel.css') }}">

  <style media="screen">

  .lab {
      margin-top: 6.3rem;
  }

  </style>

@endsection
