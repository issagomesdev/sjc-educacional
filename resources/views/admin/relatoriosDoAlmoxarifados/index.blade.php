@extends('layouts.admin')
<title> Relatórios do Almoxarifado </title>
@section('content')

<div class="card">
    <div class="card-header">
        Relatórios do Almoxarifado
    </div>
    </div>

<div class="cards-icons">

  <div class="card-icons">
    <div class="card-body">
      <div class="card-icon">
      <a href="{{ route("admin.relatorios-do-almoxarifados.fornecedores") }}">
      <i class="icon fas fa-people-carry-box fa-7x" ></i>
      <div class="lab"> <span> Fornecedores </span> </div>
      </a>
      </div>
    </div>
    </div>


    <div class="card-icons">
      <div class="card-body">
        <div class="card-icon">
        <a href="{{ route("admin.relatorios-do-almoxarifados.requisitantes") }}">
        <i class="icon fas fa-person-booth fa-7x" ></i>
        <div class="lab"> <span> Requisitanes </span> </div>
        </a>
        </div>
      </div>
      </div>

      <div class="card-icons">
        <div class="card-body">
          <div class="card-icon">
          <a href="{{ route("admin.relatorios-do-almoxarifados.estoques") }}?estoque=all">
          <i class="icon fas fa-dolly fa-7x" ></i>
          <div class="lab"> <span> Estoques </span> </div>
          </a>
          </div>
        </div>
        </div>

        <div class="card-icons">
          <div class="card-body">
            <div class="card-icon">
            <a href="{{ route("admin.relatorios-do-almoxarifados.produtos") }}">
            <i class="icon fa-fw fas fa-parachute-box fa-7x" ></i>
            <div class="lab"> <span> Produtos </span> </div>
            </a>
            </div>
          </div>
          </div>

  <div class="card-icons">
    <div class="card-body">
      <div class="card-icon">
      <a href="{{ route("admin.relatorios-do-almoxarifados.entradas") }}">
      <i class="icon fa-fw fas fa-door-closed fa-7x" ></i>
      <div class="lab"> <span> Entrada no Estoque </span> </div>
      </a>
      </div>
    </div>
    </div>

    <div class="card-icons">
      <div class="card-body">
        <div class="card-icon">
        <a href="{{ route("admin.relatorios-do-almoxarifados.saidas") }}">
        <i class="icon fas fa-door-open fa-7x" ></i>
        <div class="lab"> <span> Saída No Estoque </span> </div>
        </a>
        </div>
      </div>
      </div>

      <div class="card-icons">
        <div class="card-body">
          <div class="card-icon">
          <a href="{{ route("admin.relatorios-do-almoxarifados.requisicos") }}">
          <i class="icon fas fa-user-plus fa-7x" ></i>
          <div class="lab"> <span> Requisições </span> </div>
          </a>
          </div>
        </div>
        </div>

        <div class="card-icons">
          <div class="card-body">
            <div class="card-icon">
            <a href="{{ route("admin.relatorios-do-almoxarifados.pedidos") }}">
            <i class="icon fas fa-cart-shopping fa-7x" ></i>
            <div class="lab"> <span> Pedidos De Compra </span> </div>
            </a>
            </div>
          </div>
          </div>

      </div>

  <link rel="stylesheet" href="{{ url('reports/icons.css') }}">
  <link rel="stylesheet" href="{{ url('reports/response.css') }}">
  <link rel="stylesheet" href="{{ url('css/panel.css') }}">

  <style media="screen">

  .card-icons {
      width: 10rem;
      height: 11rem !important;
  }

  </style>

@endsection
