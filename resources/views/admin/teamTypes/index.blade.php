@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-top">

    @can('team_access')
      <a href="{{ route("admin.teams.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/teams") || request()->is("admin/teams/*") ? "c-active" : "" }}">
        <i class="fa-fw fas fa-university c-sidebar-nav-icon"> </i> Instituição </a> @endcan

    @can('team_type_access')
      <a href="{{ route("admin.team-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/team-types") || request()->is("admin/team-types/*") ? "c-active" : "" }}">
        <i class="fa-fw fas fa-tags c-sidebar-nav-icon"> </i> Tipos de Instituição </a> @endcan

    </div>
    </div>

@can('team_type_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.team-types.create') }}">
                Cadastrar Tipo de Instituição
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Tipos de Instituição
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-TeamType">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.teamType.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.teamType.fields.titulo') }}
                        </th>
                        <th>
                            {{ trans('cruds.teamType.fields.assinatura') }}
                        </th>
                        <th>
                            {{ trans('cruds.teamType.fields.team') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teamTypes as $key => $teamType)
                        <tr data-entry-id="{{ $teamType->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $teamType->id ?? '' }}
                            </td>
                            <td>
                                {{ $teamType->titulo ?? '' }}
                            </td>
                            <td>
                                {{ $teamType->assinatura->name ?? '' }}
                            </td>
                            <td>
                                {{ $teamType->team->name ?? '' }}
                            </td>
                            <td>
                                @can('team_type_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.team-types.show', $teamType->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('team_type_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.team-types.edit', $teamType->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('team_type_delete')
                                    <form action="{{ route('admin.team-types.destroy', $teamType->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style media="screen">

a.c-sidebar-nav-link {
    color: #000000c7;
}

.container-fluid {
    margin-top: 12rem;
}

.card-top {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1.25rem;
    display: flex;
}

a.c-sidebar-nav-link.c-active {
    color: #2eb85c;
}

</style>

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('team_type_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.team-types.massDestroy') }}",
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
  let table = $('.datatable-TeamType:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
