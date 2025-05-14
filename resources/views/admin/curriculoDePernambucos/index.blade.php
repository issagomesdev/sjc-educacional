@extends('layouts.admin')
@section('content')

@can('curriculo_de_pernambuco_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.curriculo-de-pernambucos.create') }}">
                Adicionar Currículo de Pernambuco
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Currículo de Pernambuco
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-CurriculoDePernambuco">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            Codigo
                        </th>
                        <th>
                            Objetivo e Habilidades
                        </th>
                        <th>
                            Nível De Ensino
                        </th>
                        <th>
                            Séries
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
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                          <select class="search">
                              <option value>{{ trans('global.all') }}</option>
                              <option value="Ensino Infantil"> Ensino Infantil</option>
                              <option value="Ensino Fundamental"> Ensino Fundamental </option>
                              <option value="Ensino Fundamental 2"> Ensino Fundamental 2 </option>
                              <option value="EJA"> EJA </option>
                          </select>
                        </td>
                        <td>
                          <select class="search">
                              <option value>{{ trans('global.all') }}</option>
                              <option value="Creche 1"> Creche 1</option>
                              <option value="Creche 2"> Creche 2</option>
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
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($users as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($teams as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($curriculoDePernambucos as $key => $curriculoDePernambuco)
                        <tr data-entry-id="{{ $curriculoDePernambuco->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $curriculoDePernambuco->codigo ?? '' }}
                            </td>
                            <td>
                                {{ $curriculoDePernambuco->objetivo_habilidade ?? '' }}
                            </td>
                            <td>
                                {{ $curriculoDePernambuco->nivel_de_ensino ?? '' }}
                            </td>
                            <td>
                                @foreach($series as $serie) @if($serie->curriculo_de_pernambuco_id == $curriculoDePernambuco->id) <span class="badge badge-info">{{ $serie->serie }}</span> @endif @endforeach
                            </td>
                            <td>
                                {{ $curriculoDePernambuco->assinatura->name ?? '' }}
                            </td>
                            <td>
                                {{ $curriculoDePernambuco->team->name ?? '' }}
                            </td>
                            <td>
                                {{ $curriculoDePernambuco->created_at ?? '' }}
                            </td>
                                <td class="btnn">
                                 <div class="header">
                                 <div class="dropdown">
                                   <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $curriculoDePernambuco->id }}()"> <li></li> <li></li> <li></li> </ul>
                                   <div id="myDropdown{{ $curriculoDePernambuco->id }}" class="dropdown-content">
                                   @can('curriculo_de_pernambuco_show') <a href="{{ route('admin.curriculo-de-pernambucos.show', $curriculoDePernambuco->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                                   @can('curriculo_de_pernambuco_edit') <a href="{{ route('admin.curriculo-de-pernambucos.edit', $curriculoDePernambuco->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                                   @can('curriculo_de_pernambuco_delete') <form id="delete-{{ $curriculoDePernambuco->id }}" action="{{ route('admin.curriculo-de-pernambucos.destroy', $curriculoDePernambuco->id) }}" method="POST">  @method('DELETE') @csrf </form>
                                   <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $curriculoDePernambuco->id }}').submit()">
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

                                function showDropdown{{ $curriculoDePernambuco->id }}() {
                                document.getElementById("myDropdown{{ $curriculoDePernambuco->id }}").classList.toggle("dshow");
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

<link rel="stylesheet" href="{{ url('css/hide-menu.css') }}">
<link rel="stylesheet" href="{{ url('resources/curriculo-de-pernambucos.css') }}">


@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('curriculo_de_pernambuco_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.curriculo-de-pernambucos.massDestroy') }}",
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
    pageLength: 100,
  });
  let table = $('.datatable-CurriculoDePernambuco:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
