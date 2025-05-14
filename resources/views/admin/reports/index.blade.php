@extends('layouts.admin')
    <title> Relatórios </title>
@section('content')

<div class="card">
    <div class="card-header">
        Relatórios
    </div>
    </div>

<div class="cards-icons">

  <div class="card-icons">
    <div class="card-body">
      <div class="card-icon">
      <a href="{{ route("admin.reports.usuarios") }}">
      <i class="icon fas fa-user fa-7x" ></i>
      <div class="lab"> <span> Usuários </span> </div>
      </a>
      </div>
    </div>
    </div>


    <div class="card-icons">
      <div class="card-body">
        <div class="card-icon">
        <a href="{{ route("admin.reports.teams") }}?type=all&localizacao=all&estado=all&situacao=all&administracao=all">
        <i class="icon fas fa-school fa-7x" ></i>
        <div class="lab"> <span> Instituições </span> </div>
        </a>
        </div>
      </div>
      </div>

      <div class="card-icons">
        <div class="card-body">
          <div class="card-icon">
          <a href="{{ route("admin.reports.profissionais") }}?genero=all&localizacao=all&estado=all&situacao=all&funcao=all&instituicao=all">
          <i class="icon fas fa-user-tie fa-7x" ></i>
          <div class="lab"> <span> Profissionais </span> </div>
          </a>
          </div>
        </div>
        </div>

        <div class="card-icons">
          <div class="card-body">
            <div class="card-icon">
            <a href="{{ route("admin.reports.estudantes") }}?escola=all&serie=all&genero=all&situacao=all&localizacao=all&estado=all">
            <i class="icon fa-fw fas fa-user-graduate fa-7x" ></i>
            <div class="lab"> <span> Estudantes </span> </div>
            </a>
            </div>
          </div>
          </div>

  <div class="card-icons">
    <div class="card-body">
      <div class="card-icon">
      <a href="{{ route("admin.reports.turmas") }}?escola=all&tipo=all&nivel=all&turno=all&serie=all">
      <i class="icon fa-fw fas fa-user-friends fa-7x" ></i>
      <div class="lab"> <span> Turmas </span> </div>
      </a>
      </div>
    </div>
    </div>

    <div class="card-icons">
      <div class="card-body">
        <div class="card-icon">
        <a href="{{ route("admin.reports.desempenho") }}?escola=all&ano=all&turno=all&nivel=all&disciplina=all&serie=all">
        <i class="icon fas fa-chart-line fa-7x" ></i>
        <div class="lab"> <span> Desempenho </span> </div>
        </a>
        </div>
      </div>
      </div>

      </div>

  <link rel="stylesheet" href="{{ url('reports/icons.css') }}">
  <link rel="stylesheet" href="{{ url('reports/response.css') }}">
  <link rel="stylesheet" href="{{ url('css/panel.css') }}">

@endsection
