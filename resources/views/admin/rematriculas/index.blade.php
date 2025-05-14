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

@can('rematricula_create')

<div class="contein">
  <form method="GET" action="{{ route("admin.enturmacao.create") }}">
      @csrf

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
    <input class="btn btn-success" type="submit" value="Rematricular Alunos"> </div>
  </div>
  </form>
  </div>

@endcan


<div class="card">
    <div class="card-header">
        Registros da Rematricula
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable-Rematricula">
                <thead>
                    <tr>
                        <th class="noExport" width="10"> </th>
                        <th class="noExport"> </th>

                        <th>
                            {{ trans('cruds.rematricula.fields.ano') }}
                        </th>
                        <th>
                            {{ trans('cruds.rematricula.fields.escola') }}
                        </th>
                        <th>
                            {{ trans('cruds.rematricula.fields.turma') }}
                        </th>
                        <th>
                            {{ trans('cruds.rematricula.fields.turma_nova') }}
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
                        <td class="d"> </td>
                        @endif
                        <td> <p class="fil">Escola</p>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($teams as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> <p class="fil">Turma</p>
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
                        <td> <p class="fil">Turma destino</p>
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
                        <td> </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rematriculas as $key => $rematricula)
                        <tr data-entry-id="{{ $rematricula->id }}">
                            <td> </td>
                            <td>
                                <p> <strong>Ano:</strong> {{ $rematricula->ano ?? '' }} </p>
                                <p> <strong>Escola:</strong> {{ $rematricula->escola->name ?? '' }} </p>
                                <p> <strong>Turma:</strong> {{ $rematricula->turma->serie ?? '' }} {{ $rematricula->turma->identificacao ?? '' }} - {{ $rematricula->turma->nivel_da_turma ?? '' }} </p>
                                <p> <strong>Turma destino:</strong> {{ $rematricula->turma_nova->serie ?? '' }} {{ $rematricula->turma_nova->identificacao ?? '' }} - {{ $rematricula->turma_nova->nivel_da_turma ?? '' }} </p>
                                <p class="cad">
                                cadastrado em {{ $rematricula->created_at ?? '' }} por {{ $rematricula->assinatura->name ?? '' }} de {{ $rematricula->team->name ?? '' }}
                                </p>
                            </td>
                            <td class="invisib">
                                {{ $rematricula->ano ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $rematricula->escola->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $rematricula->turma->serie ?? '' }} {{ $rematricula->turma->identificacao ?? '' }} - {{ $rematricula->turma->nivel_da_turma ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $rematricula->turma_nova->serie ?? '' }} {{ $rematricula->turma_nova->identificacao ?? '' }} - {{ $rematricula->turma_nova->nivel_da_turma ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $rematricula->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $rematricula->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $rematricula->created_at ?? '' }}
                            </td>
                                <td class="btnn">
                                 <div class="header">
                                 <div class="dropdown">
                                   <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $rematricula->id }}()"> <li></li> <li></li> <li></li> </ul>
                                   <div id="myDropdown{{ $rematricula->id }}" class="dropdown-content">
                                  @can('rematricula_show') <a href="{{ route('admin.rematriculas.show', $rematricula->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
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

                                function showDropdown{{ $rematricula->id }}() {
                                document.getElementById("myDropdown{{ $rematricula->id }}").classList.toggle("dshow");
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
<link rel="stylesheet" href="{{ url('resources/rematriculas.css') }}">


@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('rematricula_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.rematriculas.massDestroy') }}",
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
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-Rematricula:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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

</script>
@endsection
