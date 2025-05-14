@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-top">
      @can('profissional_access')
              <a href="{{ route("admin.profissionais.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/profissionais") || request()->is("admin/profissionais/*") ? "c-active" : "" }}">
                  <i class="fa-fw fas fa-user-alt c-sidebar-nav-icon">  </i>
                  Profissionais
              </a>
      @endcan

      @can('tipo_de_profissional_access')
                            <a href="{{ route("admin.tipo-de-profissionals.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tipo-de-profissionals") || request()->is("admin/tipo-de-profissionals/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-tag c-sidebar-nav-icon"> </i>
                                Tipos de Profissionais
                            </a>
      @endcan
      @can('instalar_access')
              <a href="{{ route("admin.instalars.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/instalars") || request()->is("admin/instalars/*") ? "c-active" : "" }}">
                  <i class="fa-fw fas fa-user-plus c-sidebar-nav-icon"> </i>
                  Instalar Profissional
              </a>
      @endcan
      @can('deslocar_access')
              <a href="{{ route("admin.deslocars.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/deslocars") || request()->is("admin/deslocars/*") ? "c-active" : "" }}">
                  <i class="fa-fw fas fa-user-minus c-sidebar-nav-icon">   </i>
                  Deslocar Profissional
              </a>
      @endcan
    </div>
    </div>

@can('profissional_create')

    <div class="contein">
      <form method="GET" action="{{ route("admin.profissionais.create") }}">
          @csrf
          <div class="form-group">
            <select class="form-control selectd" name="ano" id="ano" required>
              <option value="">Selecione ano</option>
                @foreach($anos_letivos_abertos as $ano_aberto)
                    <option value="{{ $ano_aberto['ano'] }}">{{ $ano_aberto['ano'] }}</option>
                @endforeach
            </select>
        </div>
        <div style="margin-bottom: 10px;" class="row"> <div class="col-lg-12">
        <input class="btn btn-success" type="submit" value="Cadastrar Profissional"> </div>
      </div>
      </form>

@endcan

<div class="card">
    <div class="card-header">
        Registros de Profissionais
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable-Profissional">
                <thead>
                    <tr>
                      <th class="noExport" width="10"></th>
                      <th class="noExport"> </th>

                        <th>
                            Nome Completo
                        </th>
                        <th>
                            Genero
                        </th>
                        <th>
                            Localizacao
                        </th>
                        <th>
                            Estado
                        </th>
                        <th>
                            Cidade
                        </th>
                        <th>
                            Ano de contratação
                        </th>
                        <th>
                            Situação de contratação
                        </th>
                        <th>
                          Função
                        </th>
                        <th>
                            Instituição
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
                        <td class="d"> </td>
                        <td> <p class="fil">Genero</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Profissionai::GENERO_RADIO as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> <p class="fil">Localização</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Profissionai::LOCALIZACAO_RADIO as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> <p class="fil">Estado</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Profissionai::ESTADO_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td> <p class="fil">Situação</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Profissionai::SITUACAO_DE_CONTRATACAO_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> <p class="fil">Função</p>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($tipo_de_profissionals as $key => $item)
                                    <option value="{{ $item->titulo }}">{{ $item->titulo }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> <p class="fil">Instituição</p>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                <option value="Não atribuido">Não atribuido</option>
                                @foreach($teams as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td> </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($profissionais as $key => $profissionai)
                        <tr data-entry-id="{{ $profissionai->id }}">
                            <td> </td>
                            <td>
                                <p> <strong>Nome:</strong> {{ $profissionai->nome_completo ?? 'Não atribuido' }} </p>
                                <p> <strong>Genero:</strong> {{ App\Models\Profissionai::GENERO_RADIO[$profissionai->genero] ?? '' }} </p>
                                <p> <strong>Localização:</strong> {{ App\Models\Profissionai::LOCALIZACAO_RADIO[$profissionai->localizacao] ?? 'Não atribuido' }} </p>
                                <p> <strong>Estado:</strong> {{ App\Models\Profissionai::ESTADO_SELECT[$profissionai->estado] ?? 'Não atribuido' }} </p>
                                <p> <strong>Cidade:</strong> {{ $profissionai->cidade ?? 'Não atribuido' }} </p>
                                <p> <strong>Ano de contratação:</strong> {{ $profissionai->ano_de_contratacao ?? 'Não atribuido' }} </p>
                                <p> <strong>Situação de contratação:</strong> {{ App\Models\Profissionai::SITUACAO_DE_CONTRATACAO_SELECT[$profissionai->situacao_de_contratacao] ?? 'Não atribuido' }} </p>
                                <p> <strong>Função:</strong> @foreach($profissionai->funcaos as $key => $item) <span class="badge badge-info">{{ $item->titulo }}</span> @endforeach </p>
                                <p> <strong>Instituição:</strong> {{ $profissionai->instituicao->name ?? 'Não atribuido' }} </p>
                                <p class="cad">
                                cadastrado em {{ $profissionai->created_at ?? '' }} por {{ $profissionai->assinatura->name ?? '' }} de {{ $profissionai->team->name ?? '' }}
                                </p>
                            </td>
                            <td class="invisib">
                                {{ $profissionai->nome_completo ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\Profissionai::GENERO_RADIO[$profissionai->genero] ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\Profissionai::LOCALIZACAO_RADIO[$profissionai->localizacao] ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\Profissionai::ESTADO_SELECT[$profissionai->estado] ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $profissionai->cidade ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $profissionai->ano_de_contratacao ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ App\Models\Profissionai::SITUACAO_DE_CONTRATACAO_SELECT[$profissionai->situacao_de_contratacao] ?? '' }}
                            </td>
                            <td class="invisib">
                              @foreach($profissionai->funcaos as $key => $item) <span class="badge badge-info">{{ $item->titulo }}</span> @endforeach
                            </td>
                            <td class="invisib">
                                {{ $profissionai->instituicao->name ?? 'Não atribuido' }}
                            </td>
                            <td class="invisib">
                                {{ $profissionai->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $profissionai->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $profissionai->created_at ?? '' }}
                            </td>
                                    <td class="btnn">
                                     <div class="header">
                                     <div class="dropdown">
                                       <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $profissionai->id }}()"> <li></li> <li></li> <li></li> </ul>
                                       <div id="myDropdown{{ $profissionai->id }}" class="dropdown-content">
                                       @can('profissional_show') <a href="{{ route('admin.profissionais.show', $profissionai->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                                       @can('profissional_show') <a href="{{ route('admin.profissionais.edit', $profissionai->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                                       @can('profissional_delete') <form id="delete-{{ $profissionai->id }}" action="{{ route('admin.profissionais.destroy', $profissionai->id) }}" method="POST">  @method('DELETE') @csrf </form>
                                       <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $profissionai->id }}').submit()">
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

                                    function showDropdown{{ $profissionai->id }}() {
                                    document.getElementById("myDropdown{{ $profissionai->id }}").classList.toggle("dshow");
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
<link rel="stylesheet" href="{{ url('resources/profissionais.css') }}">

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('matricula_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.profissionais.massDestroy') }}",
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
  let table = $('.datatable-Profissional:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
