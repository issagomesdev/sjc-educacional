@extends('layouts.admin')
@section('content')
@can('user_create')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.users.create') }}">
                Cadastrar Usuário
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
      Registros do Usuário
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable datatable-User">

                <thead>
                    <tr>
                        <th class="noExport" width="10%">

                        </th>
                        <th class="noExport" id="th-body"></th>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.tipo_de_acesso') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.situacao') }}
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
                            Em:
                        </th>
                        <th class="noExport">
                            &nbsp;
                        </th>
                    </tr>
                    <tr class="div-filter">
                        <td> </td>
                        <td> </td>

                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td> <p class="fil">Hierarquia</p>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($roles as $key => $item)
                                    <option value="{{ $item->title }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> <p class="fil">Tipo De Acesso</p>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($types as $key => $item)
                                    <option value="{{ $item->titulo }}">{{ $item->titulo }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td> <p class="fil">Situação</p>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\User::SITUACAO_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        @if($autht[0] == 2)
                        <td> <p class="fil">Instituição</p>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($teams as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        @else
                        <td> <p class="fil">Instituição</p>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($yout as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        @endif
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td class="d"> </td>
                        <td> </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $key => $user)
                        <tr class="m_esc" data-entry-id="{{ $user->id }}">
                            <td> </td>
                            <td>
                              <p> <strong>Nome:</strong> {{ $user->name ?? 'Não atribuido' }} </p>
                              <p> <strong>Email:</strong> {{ $user->email ?? 'Não atribuido' }} </p>
                              <p> <strong>Hierarquia:</strong> @foreach($user->roles as $key => $item)<span class="badge badge-info">{{ $item->title }}</span> @endforeach </p>
                              <p> <strong>Instituição:</strong> {{ $user->team->name ?? 'Não atribuido' }}
                              <p> <strong>Situação:</strong> {{ App\Models\User::SITUACAO_SELECT[$user->situacao] ?? 'Ativo' }} </p>
                              <p> <strong>Tipo De Acesso:</strong> @foreach($user->tipo_de_acessos as $key => $item) {{ $item->titulo }} @endforeach </p>
                                <p class="cad">
                                cadastrado em {{ $user->created_at ?? '' }} por {{ $user->assinatura->name ?? '' }} de {{ $user->assinatura_team->name ?? '' }}
                                </p>
                            </td>
                            <td class="invisib">
                                {{ $user->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $user->email ?? '' }}
                            </td>
                            <td class="invisib">
                                @foreach($user->roles as $key => $item)
                                    {{ $item->title }}
                                @endforeach
                            </td>
                            <td class="invisib">
                                @foreach($user->tipo_de_acessos as $key => $item)
                                    {{ $item->titulo }}
                                @endforeach
                            </td>
                            <td class="invisib">
                                {{ App\Models\User::SITUACAO_SELECT[$user->situacao] ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $user->team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $user->assinatura->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $user->assinatura_team->name ?? '' }}
                            </td>
                            <td class="invisib">
                                {{ $user->created_at ?? '' }}
                            </td>
                            <td class="btnn">
                              <div class="header">
                              <div class="dropdown">
                                <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $user->id }}()"> <li></li> <li></li> <li></li> </ul>
                                <div id="myDropdown{{ $user->id }}" class="dropdown-content">
                                @can('user_show') <a href="{{ route('admin.users.show', $user->id) }}"> <i class="fa fa-user fa-lg"></i> {{ trans('global.view') }} </a> @endcan
                                @can('user_edit') <a href="{{ route('admin.users.edit', $user->id) }}"> <i class="fa fa-edit"></i> {{ trans('global.edit') }} </a> @endcan
                                @can('user_delete') <form id="delete-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST">  @method('DELETE') @csrf </form>
                                <a class="dropdown-item" href="#" onclick="if(confirm('{{ trans('global.areYouSure') }}')) document.getElementById('delete-{{ $user->id }}').submit()">
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

                        function showDropdown{{ $user->id }}() {
                          document.getElementById("myDropdown{{ $user->id }}").classList.toggle("dshow");
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
<link rel="stylesheet" href="{{ url('resources/users.css') }}">

@endsection
@section('scripts')
@parent

<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
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
  let table = $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
