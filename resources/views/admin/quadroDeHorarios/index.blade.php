@extends('layouts.admin')
@section('content')



@can('quadro_de_horario_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">

<a class="btn btn-success" href="{{ route("admin.quadro-de-horarios.create") }}">
    Adicionar Horário
</a>

</div>
</div>

@endcan

<div class="card">
    <div class="card-header">
        Quadro De Horários
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-QuadroDeHorario">
                <thead>
                    <tr>
                        <th class="noExport"  width="10">

                        </th>
                        <th>
                            Ano
                        </th>
                        <th>
                            Escola
                        </th>
                        <th>
                            Período
                        </th>
                        <th>
                            Dias
                        </th>
                        <th>
                            Horário
                        </th>
                        <th>
                            Turma
                        </th>

                        <th>
                            Matéria
                        </th>
                        <th>
                            Professor
                        </th>
                        <th class="noExport" >
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                          <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($anos_letivos as $anos)
                                <option value="{{ $anos['ano'] }}">{{ $anos['ano'] }}</option>
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
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\QuadroDeHorario::PERIODO_RADIO as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\QuadroDeHorario::DIAS_RADIO as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
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
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($materia as $key => $item)
                                    <option value="{{ $item->nome_da_materia }}">{{ $item->nome_da_materia }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($educadores as $key => $item)
                                    <option value="{{ $item->nome_completo }}">{{ $item->nome_completo }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quadroDeHorarios as $key => $quadroDeHorario)
                        <tr data-entry-id="{{ $quadroDeHorario->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $quadroDeHorario->ano ?? '' }}
                            </td>
                            <td>
                                {{ $quadroDeHorario->escola->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\QuadroDeHorario::PERIODO_RADIO[$quadroDeHorario->periodo] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\QuadroDeHorario::DIAS_RADIO[$quadroDeHorario->dias] ?? '' }}
                            </td>
                            <td>
                                {{ $quadroDeHorario->horario }}
                            </td>
                            <td>
                                {{ $quadroDeHorario->turma->serie ?? '' }} {{ $quadroDeHorario->turma->identificacao ?? '' }} - {{ $quadroDeHorario->turma->nivel_da_turma ?? '' }}
                            </td>
                            <td>
                                {{ $quadroDeHorario->materias->nome_da_materia ?? '' }}
                            </td>
                            <td>
                                {{ $quadroDeHorario->professor->nome_completo ?? '' }}
                            </td>

                                <td class="btnn">
                                 <div class="header">
                                 <div class="dropdown">
                                   <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $quadroDeHorario->id }}()"> <li></li> <li></li> <li></li> </ul>
                                   <div id="myDropdown{{ $quadroDeHorario->id }}" class="dropdown-content">
                                   @can('quadro_de_horario_show') <a href="{{ route('admin.quadro-de-horarios.show', $quadroDeHorario->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                                   @can('quadro_de_horario_edit') <a href="{{ route('admin.quadro-de-horarios.edit', $quadroDeHorario->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                                   @can('quadro_de_horario_delete') <form id="delete-{{ $quadroDeHorario->id }}" action="{{ route('admin.quadro-de-horarios.destroy', $quadroDeHorario->id) }}" method="POST">  @method('DELETE') @csrf </form>
                                   <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $quadroDeHorario->id }}').submit()">
                                   <i class="fa fa-trash"> </i> {{ trans('global.delete') }} </a> @endcan
                                   </div>
                                 </div>
                                </div>
                                </td>
                                </tr>
                                </div>
                                @section('scripts')
                                @parent
                                <script>

                                function changeLanguage(language) {
                                var element = document.getElementById("url");
                                element.value = language;
                                element.innerHTML = language;
                                }

                                function showDropdown{{ $quadroDeHorario->id }}() {
                                document.getElementById("myDropdown{{ $quadroDeHorario->id }}").classList.toggle("show");
                                }

                                // Close the dropdown if the user clicks outside of it
                                window.onclick = function(event) {
                                if (!event.target.matches(".dropbtn")) {
                                var dropdowns = document.getElementsByClassName("dropdown-content");
                                var i;
                                for (i = 0; i < dropdowns.length; i++) {
                                var openDropdown = dropdowns[i];
                                if (openDropdown.classList.contains("show")) {
                                openDropdown.classList.remove("show");
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


<link rel="stylesheet" href="{{ url('resources/quadro-de-horarios.css') }}">

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('quadro_de_horario_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.quadro-de-horarios.massDestroy') }}",
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
  let table = $('.datatable-QuadroDeHorario:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
