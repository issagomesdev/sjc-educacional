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

@can('cadastro_create')

<div class="contein">
  <form method="GET" action="{{ route("admin.cadastros.create") }}">
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
    <input class="btn btn-success" type="submit" value="Matricular Aluno"> </div>
  </div>
  </form>
  </div>

@endcan

<div class="card">
    <div class="card-header">
        Registros dos Alunos
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable-Cadastro">
                <thead>
                    <tr>
                        <th class="noExport" width="10"></th>
                        <th class="noExport"> </th>
                        <th>
                            Ano
                        </th>
                        <th>
                            {{ trans('cruds.cadastro.fields.nome_completo') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastro.fields.localizacao') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastro.fields.estado') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastro.fields.cidade') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastro.fields.escola') }}
                        </th>
                        <th>
                            {{ trans('cruds.cadastro.fields.turma') }}
                        </th>
                        <th>
                            Situação
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
                        <td class="d"> </td>
                        <td> <p class="fil">Localização</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                <option value="Não atribuido">Não atribuido</option>
                                @foreach(App\Models\Cadastro::LOCALIZACAO_RADIO as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> <p class="fil">Estado</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                <option value="Não atribuido">Não atribuido</option>
                                @foreach(App\Models\Cadastro::ESTADO_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="d"> </td>
                        @if($auth[0] == 2)
                        <td> <p class="fil">Escola</p>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                <option value="Não atribuido">Não atribuido</option>
                                @foreach($teams as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        @else
                        <td> <p class="fil">Escola</p>
                            <select class="search">
                                @foreach($tid as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        @endif
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
                        <td> <p class="fil">Situação</p>
                          <select class="search" strict="true">
                              <option value>{{ trans('global.all') }}</option>
                              @foreach(App\Models\Cadastro::SITUACAO_ALUNO as $key => $item)
                                  <option value="{{ $item }}">{{ $item }}</option>
                              @endforeach
                          </select>
                        </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td> </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cadastros as $key => $cadastro)
                        <tr data-entry-id="{{ $cadastro->id }}">
                            <td> </td>
                            <td class="no-visible">
                                @if($cadastro->foto_do_aluno)
                                    <a href="{{ $cadastro->foto_do_aluno->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $cadastro->foto_do_aluno->getUrl() }}">
                                    </a>
                                    @else
                                    <a href="{{ url('null/nullphoto.png') }}" target="_blank" style="display: inline-block">
                                        <img src="{{ url('null/nullphoto.png') }}">
                                    </a>
                                @endif

                                <p> <strong>Ano:</strong> {{ $cadastro->ano ?? 'Não atribuido' }} </p>
                                <p> <strong>Nome:</strong> {{ $cadastro->nome_completo ?? 'Não atribuido' }} </p>
                                <p> <strong>Localização:</strong> {{ App\Models\Cadastro::LOCALIZACAO_RADIO[$cadastro->localizacao] ?? 'Não atribuido' }} </p>
                                <p> <strong>Estado:</strong> {{ App\Models\Cadastro::ESTADO_SELECT[$cadastro->estado] ?? 'Não atribuido' }} </p>
                                <p> <strong>Cidade:</strong> {{ $cadastro->cidade ?? 'Não atribuido' }} </p>
                                <p class="esc"> <strong class="e">Escola: {{ $cadastro->escola->name ?? 'Não atribuido' }}</strong>
                                <strong class="t">Turma: {{ $cadastro->turma->serie ?? 'Não atribuido' }} {{ $cadastro->turma->identificacao ?? '' }} </strong>
                                @if($cadastro->situacao == 0) <strong class="c"> {{ App\Models\Cadastro::SITUACAO_ALUNO[$cadastro->situacao] ?? 'Não atribuido' }} </strong> @endif @if($cadastro->situacao == 1) <strong class="m"> {{ App\Models\Cadastro::SITUACAO_ALUNO[$cadastro->situacao] ?? 'Não atribuido' }} </strong> @endif @if($cadastro->situacao == 2) <strong class="tr"> {{ App\Models\Cadastro::SITUACAO_ALUNO[$cadastro->situacao] ?? 'Não atribuido' }} </strong> @endif </p>
                                <p class="cad">
                                cadastrado em {{ $cadastro->created_at ?? '' }} por {{ $cadastro->assinatura->name ?? '' }} de {{ $cadastro->team->name ?? '' }}
                                </p>
                            </td>
                            <td class="invisib">
                                {{ $cadastro->ano }}
                            </td>
                            <td class="invisib">
                                {{ $cadastro->nome_completo ?? 'Não atribuido' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\Cadastro::LOCALIZACAO_RADIO[$cadastro->localizacao] ?? 'Não atribuido' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\Cadastro::ESTADO_SELECT[$cadastro->estado] ?? 'Não atribuido' }}
                            </td>
                            <td class="invisib">
                                {{ $cadastro->cidade ?? 'Não atribuido' }}
                            </td>
                            <td class="invisib">
                                {{ $cadastro->escola->name ?? 'Não atribuido' }}
                            </td>
                            <td class="invisib">
                                {{ $cadastro->turma->serie ?? 'Não atribuido' }} {{ $cadastro->turma->identificacao ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\Cadastro::SITUACAO_ALUNO[$cadastro->situacao] ?? 'Não atribuido' }}
                            </td>
                            <td class="invisib">
                                {{ $cadastro->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $cadastro->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $cadastro->created_at ?? '' }}
                            </td>
                                <td class="btnn">
                                 <div class="header">
                                 <div class="dropdown">
                                   <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $cadastro->id }}()"> <li></li> <li></li> <li></li> </ul>
                                   <div id="myDropdown{{ $cadastro->id }}" class="dropdown-content">
                                     <a href="{{ route('admin.cadastros.declaracao') }}?aluno={{$cadastro->id}}"> <i class="fas fa-pen-alt"></i> Declaração de Matricula </a>
                                   @can('cadastro_show') <a href="{{ route('admin.cadastros.show', $cadastro->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                                   @can('cadastro_edit') <a href="{{ route('admin.cadastros.edit', $cadastro->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                                   @can('cadastro_delete') <form id="delete-{{ $cadastro->id }}" action="{{ route('admin.cadastros.destroy', $cadastro->id) }}" method="POST">  @method('DELETE') @csrf </form>
                                   <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $cadastro->id }}').submit()">
                                   <i class="fa fa-trash"> </i> {{ trans('global.delete') }} </a> @endcan
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

                                function showDropdown{{ $cadastro->id }}() {
                                document.getElementById("myDropdown{{ $cadastro->id }}").classList.toggle("dshow");
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
</div>

<link rel="stylesheet" href="{{ url('css/panel.css') }}">
<link rel="stylesheet" href="{{ url('css/hide-menu.css') }}">
<link rel="stylesheet" href="{{ url('resources/estudantes.css') }}">

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('cadastro_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.cadastros.massDestroy') }}",
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
    order: [[ 2, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-Cadastro:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
