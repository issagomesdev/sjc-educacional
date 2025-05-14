@extends('layouts.admin')
@section('content')

<div class="card">
  <div class="card-top">

@can('cadastro_access')
        <a href="{{ route("admin.cadastros.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/cadastros") || request()->is("admin/cadastros/*") ? "c-active" : "" }}">
          <i class="fa-fw fas fa-user-graduate c-sidebar-nav-icon"> </i> Estudantes </a> @endcan

@can('matricula_access')
    <a href="{{ route("admin.enturmacao.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/enturmacao") || request()->is("admin/enturmacao/*") ? "c-active" : "" }}">
      <i class="fa fa-users c-sidebar-nav-icon"> </i> Enturmação </a> @endcan

@can('transferencium_access')
    <a href="{{ route("admin.transferencia.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/transferencia") || request()->is("admin/transferencia/*") ? "c-active" : "" }}">
      <i class="fa-fw fas fa-exchange-alt c-sidebar-nav-icon"> </i> Transferências </a> @endcan

@can('rematricula_access')
    <a href="{{ route("admin.rematriculas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/rematriculas") || request()->is("admin/rematriculas/*") ? "c-active" : "" }}">
      <i class="fa-fw fas fa-redo c-sidebar-nav-icon"> </i> Rematrícula </a> @endcan

  </div>
  </div>


  @can('transferencium_create')

  <div class="contein">
    <form method="GET" action="{{ route("admin.transferencia.create") }}">
        @csrf

    <div class="form-group">
      <select class="form-control selectd" name="tipo_de_transferencia" id="tipo_de_transferencia" required>
      <option value=""> Selecione Tipo de Transferencia </option>
      <option value="1">Transferência Interna</option>
      <option value="2">Transferência Externa</option>
      <option value="3">Transferência de Turma</option>
      </select>
    </div>

  @if($auth[0] == 2)

  <div class="form-group">
    <select class="form-control selectd" name="escola" id="escola" required>
      <option value=""> Selecione escola </option>
      @foreach($teams as $team)
        <option value="{{ $team->id }}">{{ $team->name }}</option>
      @endforeach
    </select>
  </div>

  @else

  <input type="hidden" value="{{Auth::user()->team_id}}" id="escola" name="escola">

  @endif

  <div class="form-group">
    <select class="form-control selectd" name="ano" id="ano" required>
        <option value=""> Selecione ano </option>
        @foreach($anos_letivos_abertos as $anos)
            <option value="{{ $anos['ano'] }}">{{ $anos['ano']}}</option>
        @endforeach
    </select>
  </div>

      <div style="margin-bottom: 10px;" class="row"> <div class="col-lg-12">
      <input class="btn btn-success" type="submit" value="Transferir Aluno"> </div>
    </div>
    </form>
    </div>

  @endcan

<div class="card">
  <div class="card-top">

    @can('transferencium_access')
    <a href="{{ route("admin.transferencia.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/transferencia") || request()->is("admin/transferencia/*") ? "c-active" : "" }}">
    Transferências <br> Realizadas <i class="fa fa-long-arrow-right c-sidebar-nav-icon"> </i> </a> @endcan

      @can('transferencium_access')
      <a href="{{ route("admin.transferencia.recebidas") }}" class="c-sidebar-nav-link {{ request()->is("admin/transferencias-recebidas") || request()->is("admin/transferencias-recebidas/*") ? "c-active" : "" }}">
      <i class="fa fa-long-arrow-left c-sidebar-nav-icon"> </i> Transferências <br> Recebidas </a> @endcan

  </div>
  </div>


<div class="card">
    <div class="card-header">
        Registros de Transferencia de Alunos
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable-Transferencium">
                <thead>
                    <tr>
                      <th class="noExport" width="10"> </th>
                      <th class="noExport"> </th>

                        <th>
                            Ano
                        </th>
                        <th>
                            Tipo de Transferência
                        </th>
                        <th>
                            Escola
                        </th>
                        <th>
                            Turma
                        </th>
                        <th>
                            Aluno
                        </th>
                        <th>
                            Por:
                        </th>
                        <th>
                            De:
                        </th>
                        <th>
                            Data
                        </th>
                        <th class="noExport">
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                      <td> </td>
                      <td> </td>
                      @if($auth[0] == 2)
                      <td> <p class="fil">Ano</p>
                          <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($anos_letivos as $ano)
                                <option value="{{ $ano['ano'] }}">{{ $ano['ano'] }}</option>
                            @endforeach
                          </select>
                      </td>
                      @else
                      <td> </td>
                      @endif
                      <td> <p class="fil">Tipo de Transferência</p>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\Transferencium::TIPO_DE_TRANSFERENCIA as $key => $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                      </td>
                        <td>  <p class="fil">Escola</p>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($teams as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> <p class="fil">Serie</p>
                          <select class="search">
                              <option value>{{ trans('global.all') }}</option>
                              <option value="Não atribuido">Não atribuido</option>
                              <option value="Creche I"> Creche I</option>
                              <option value="Creche II"> Creche II</option>
                              <option value="Pré-escolar"> Pré-escolar</option>
                              <option value="1º ano"> 1º ano </option>
                              <option value="2º ano"> 2º ano</option>
                              <option value="3º ano"> 3º ano</option>
                              <option value="4º ano"> 4º ano</option>
                              <option value="5º ano"> 5º ano</option>
                              <option value="6º ano"> 6º ano</option>
                              <option value="7º ano"> 7º ano</option>
                              <option value="8º ano"> 8º ano</option>
                              <option value="9º ano"> 9º ano</option>
                              <option value="1º ano(EJA)"> 1º ano - EJA </option>
                              <option value="2º ano(EJA)"> 2º ano - EJA </option>
                              <option value="3º ano(EJA)"> 3º ano - EJA </option>
                          </select>
                        </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transferencia as $key => $transferencium)
                        <tr data-entry-id="{{ $transferencium->id }}">
                            <td> </td>
                            <td>
                                <p> <strong>Ano:</strong> {{ $transferencium->ano ?? '' }} </p>
                                <p> <strong>Tipo:</strong> {{ App\Models\Transferencium::TIPO_DE_TRANSFERENCIA[$transferencium->tipo_de_transferencia] }} </p>
                                <p> <strong>Escola:</strong> {{ $transferencium->escola->name ?? '' }} </p>
                                <p> <strong>Turma:</strong> {{ $transferencium->turma->serie ?? '' }} {{ $transferencium->turma->identificacao ?? '' }} - {{ $transferencium->turma->nivel_da_turma ?? '' }} </p>
                                <p> <strong>Aluno:</strong> {{ $transferencium->aluno->nome_completo ?? '' }} </p>
                                <p class="cad">
                                cadastrado em {{ $transferencium->created_at ?? '' }} por {{ $transferencium->assinatura->name ?? '' }} de {{ $transferencium->team->name ?? '' }}
                                </p>
                            </td>
                            <td class="invisib">
                                {{ $transferencium->ano ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\Transferencium::TIPO_DE_TRANSFERENCIA[$transferencium->tipo_de_transferencia] }}
                            </td>
                            <td class="invisib">
                                {{ $transferencium->escola->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $transferencium->turma->serie ?? '' }} {{ $transferencium->turma->identificacao ?? '' }} - {{ $transferencium->turma->nivel_da_turma ?? '' }}
                            </td>
                            <td class="invisib">
                                  {{ $transferencium->aluno->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $transferencium->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $transferencium->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $transferencium->created_at ?? '' }}
                            </td>
                                <td class="btnn">
                                 <div class="header">
                                 <div class="dropdown">
                                   <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $transferencium->id }}()"> <li></li> <li></li> <li></li> </ul>
                                   <div id="myDropdown{{ $transferencium->id }}" class="dropdown-content">
                                  @can('transferencium_show') <a href="{{ route('admin.transferencia.show', $transferencium->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                                   </div>
                                 </div>
                                </div>
                                </td>
                                </tr>
                                @section('scripts')
                                @parent
                                <script>

                                function changeLanguage(language) {
                                var element = document.getElementById("url");
                                element.value = language;
                                element.innerHTML = language;
                                }

                                function showDropdown{{ $transferencium->id }}() {
                                document.getElementById("myDropdown{{ $transferencium->id }}").classList.toggle("dshow");
                                }

                                // Close the dropdown if the user clicks outside of it
                                window.onclick = function(event) {
                                if (!event.target.matches(".dropbtn")) {
                                var dropdowns = document.getElementsByClassName("dropdown-content");
                                var i;
                                for (i = 0; i < dropdowns.length; i++) {
                                var openDropdown = dropdowns[i];
                                if (openDropdown.classList.contains("dshow")) {
                                openDropdown.classList.remove("dshow");
                                }
                                }
                                }
                                };

                                </script>
                                @endsection
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

<link rel="stylesheet" href="{{ url('css/panel.css') }}">
<link rel="stylesheet" href="{{ url('css/hide-menu.css') }}">
<link rel="stylesheet" href="{{ url('resources/transferencia.css') }}">


@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('transferencium_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.transferencia.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 4, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-Transferencium:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

   function exportTasks(_this) {
      let _url = $(_this).data('href');
      window.location.href = _url;
   }

</script>
@endsection
