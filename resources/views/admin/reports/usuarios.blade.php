@extends('layouts.admin')

<head>
    <title> Relatórios de Usuários </title>
</head>


@section('content')

<div class="card">
    <div class="card-header">
        Relatórios de Usuários
    </div>
  </div>

    <div class="grapic">
      <table id="example" class=" table table-bordered table-striped table-hover datatable datatable-user">
        <thead>
            <tr>
              <th class="noExport"> </th>
              <th class="noSorting"> </th>
              <th style="width: 50%;" aria-sort="none"> Nome do Usuario </th>
              <th style="width: 50%;" aria-sort="none"> E-mail do Usuario </th>
              <th style="width: 50%;" aria-sort="none"> Instituição do Usuario </th>
              <th style="width: 50%;" aria-sort="none"> Grupos do Usuario </th>
              <th style="width: 50%;" aria-sort="none"> Tipo do Usuario </th>
              <th> </th>
            </tr>
            <tr>
              <td class="select"></td>
              <td> </td>
              <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
              <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
              <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
              <td> <select class="search">
              <option value>{{ trans('global.all') }}</option>
              @foreach($roles as $role)
              <option value="{{ $role->title }}">{{ $role->title }}</option>
              @endforeach
              </select> </td>
              <td> <select class="search">
                <option value>{{ trans('global.all') }}</option>
                @foreach($types as $type)
                <option value="{{ $type->titulo }}">{{ $type->titulo }}</option>
                @endforeach
                </select>
              </td>
              <td> </td>
            </tr>
          <tbody>
            @foreach($users as $user)
            <td> </td>
            <td></td>
                <td>
                   {{ $user->name }}
                </td>
                  <td>
                    {{ $user->email }}
                  </td>
                  <td>
                  {{ $user->team->name }}
                  </td>
                  <td>
                    @foreach($user->roles as $key => $item) {{ $item->title }} @endforeach </p>
                  </td>
                  <td>
                    @foreach($user->tipo_de_acessos as $key => $item) {{ $item->titulo }} @endforeach </p>
                  </td>
                  <td></td>
              </tr>
              @endforeach
          </tbody>
      </table>
</div>

<div class="card">
    <div class="card-header">
        Relatórios de Usuários Ativos no Momento
    </div>
    </div>
<div class="grapic">
<table id="example" class=" table table-bordered table-striped table-hover datatable datatable-user_active">
  <thead>
      <tr>
        <th class="noExport"> </th>
        <th class="noSorting"> </th>
        <th style="width: 50%;" aria-sort="none"> Nome do Usuario </th>
        <th style="width: 50%;" aria-sort="none"> E-mail do Usuario </th>
        <th style="width: 50%;" aria-sort="none"> Instituição do Usuario </th>
        <th style="width: 50%;" aria-sort="none"> Grupos do Usuario </th>
        <th style="width: 50%;" aria-sort="none"> Tipo do Usuario </th>
        <th> </th>
      </tr>
      <tr>
        <td class="select"></td>
        <td> </td>
        <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
        <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
        <td><input class="search" type="text" placeholder="{{ trans('global.search') }}"></td>
        <td> <select class="search">
        <option value>{{ trans('global.all') }}</option>
        @foreach($roles as $role)
        <option value="{{ $role->title }}">{{ $role->title }}</option>
        @endforeach
        </select> </td>
        <td> <select class="search">
          <option value>{{ trans('global.all') }}</option>
          @foreach($types as $type)
          <option value="{{ $type->titulo }}">{{ $type->titulo }}</option>
          @endforeach
          </select>
        </td>
        <td> </td>
      </tr>
    <tbody>
      @foreach($users_active as $user_active)
      <td> </td>
      <td></td>
          <td>
             {{ $user_active->user->name }}
          </td>
            <td>
              {{ $user_active->user->email }}
            </td>
            <td>
            {{ $user_active->user->team->name }}
            </td>
            <td>
              @foreach($user_active->user->roles as $key => $item) {{ $item->title }} @endforeach </p>
            </td>
            <td>
              @foreach($user_active->user->tipo_de_acessos as $key => $item) {{ $item->titulo }} @endforeach </p>
            </td>
            <td> </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>


<link rel="stylesheet" href="{{ url('reports/teams.css') }}">

      @endsection
      @section('scripts')
      @parent

      <!-- user -->

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
          }
        }
        dtButtons.push(deleteButton)
      @endcan

        $.extend(true, $.fn.dataTable.defaults, {
          orderCellsTop: true,
          order: [[ 2, 'desc' ]],
          pageLength: 5,
        });
        let table = $('.datatable-user:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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

      <!-- user active -->

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
          }
        }
        dtButtons.push(deleteButton)
      @endcan

        $.extend(true, $.fn.dataTable.defaults, {
          orderCellsTop: true,
          order: [[ 2, 'desc' ]],
          pageLength: 5,
        });
        let table = $('.datatable-user_active:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
