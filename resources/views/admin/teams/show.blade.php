@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Visualizar Instituição
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.teams.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table id="example" class="table table-striped table-hover table-bordered">
              <thead>
                  <tr>
                    <th class="sorting sorting_desc" tabindex="0" aria-controls="export" rowspan="1" colspan="1" aria-label=" " style="width: 100%;" aria-sort="none"> </th>
                    <th class="sorting sorting_desc" tabindex="0" aria-controls="export" rowspan="1" colspan="1" aria-label=" " style="width: 100%;" aria-sort="none"> </th>
                  </tr>
                <tbody>
                  <tr>
                      <th>
                          {{ trans('cruds.team.fields.id') }}
                      </th>
                      <td>
                          {{ $team->id }}
                      </td>
                  </tr>
                  <tr>
                      <th>
                          {{ trans('cruds.team.fields.name') }}
                      </th>
                      <td>
                          {{ $team->name }}
                      </td>
                  </tr>
                  <tr>
                      <th>
                          Tipo de Instituição
                      </th>
                      <td>
                          {{ $team->tipo_de_instituicao->titulo ?? '' }}
                      </td>
                  </tr>
                  <tr>
                      <th>
                          {{ trans('cruds.team.fields.owner') }}
                      </th>
                      <td>
                          {{ $team->owner->name ?? '' }}
                      </td>
                  </tr>
                  <tr>
                      <th>
                          {{ trans('cruds.team.fields.localizacao') }}
                      </th>
                      <td>
                          {{ App\Models\Team::LOCALIZACAO_RADIO[$team->localizacao] ?? '' }}
                      </td>
                  </tr>
                  <tr>
                      <th>
                          {{ trans('cruds.team.fields.estado') }}
                      </th>
                      <td>
                          {{ App\Models\Team::ESTADO_SELECT[$team->estado] ?? '' }}
                      </td>
                  </tr>
                  <tr>
                      <th>
                          {{ trans('cruds.team.fields.cidade') }}
                      </th>
                      <td>
                          {{ $team->cidade }}
                      </td>
                  </tr>
                  <tr>
                      <th>
                          {{ trans('cruds.team.fields.bairro') }}
                      </th>
                      <td>
                          {{ $team->bairro }}
                      </td>
                  </tr>
                  <tr>
                      <th>
                          {{ trans('cruds.team.fields.endereco') }}
                      </th>
                      <td>
                          {{ $team->endereco }}
                      </td>
                  </tr>
                  <tr>
                      <th>
                          CNPJ
                      </th>
                      <td>
                          {{ $team->cnpj }}
                      </td>
                  </tr>
                  <tr>
                      <th>
                          {{ trans('cruds.team.fields.telefone_de_contato') }}
                      </th>
                      <td>
                          {{ $team->telefone_de_contato }}
                      </td>
                  </tr>
                  <tr>
                      <th>
                          {{ trans('cruds.team.fields.telefone_de_contato_2') }}
                      </th>
                      <td>
                          {{ $team->telefone_de_contato_2 }}
                      </td>
                  </tr>
                  <tr>
                      <th>
                          {{ trans('cruds.team.fields.telefone_de_contato_3') }}
                      </th>
                      <td>
                          {{ $team->telefone_de_contato_3 }}
                      </td>
                  </tr>
                  <tr>
                      <th>
                          {{ trans('cruds.team.fields.email_de_contato') }}
                      </th>
                      <td>
                          {{ $team->email_de_contato }}
                      </td>
                  </tr>
                  <tr>
                      <th>
                          {{ trans('cruds.team.fields.dependencia_administrativa') }}
                      </th>
                      <td>
                          {{ App\Models\Team::DEPENDENCIA_ADMINISTRATIVA_SELECT[$team->dependencia_administrativa] ?? '' }}
                      </td>
                  </tr>
                  <tr>
                      <th>
                          {{ trans('cruds.team.fields.situacao') }}
                      </th>
                      <td>
                          {{ App\Models\Team::SITUACAO_SELECT[$team->situacao] ?? '' }}
                      </td>
                  </tr>
                  <tr>
                      <th>
                          Por:
                      </th>
                      <td>
                          {{ $team->assinatura->name ?? '' }}
                      </td>
                  </tr>
                  <tr>
                      <th>
                          De:
                      </th>
                      <td>
                          {{ $team->team->name ?? '' }}
                      </td>
                  </tr>
                  <tr>
                      <th>
                          Criado em
                      </th>
                      <td>
                          {{ $team->created_at }}
                      </td>
                  </tr>
                  <tr>
                      <th>
                          Atualizado em
                      </th>
                      <td>
                          {{ $team->updated_at }}
                      </td>
                  </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.teams.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

    <script>

    $(document).ready( function() {
$('#example').dataTable( {

"lengthMenu": [[ -1, 10, 25, 50], ["All", 10, 25, 50]],
dom: 'B',
order: [],
buttons: [

        {
            extend: 'copy',
            text: 'Copiar'
        },

        {
            extend: 'excel',
            text: 'Excel'
        },

        {
            extend: 'csv',
            text: 'CSV'
        },

        {
            extend: 'pdf',
            text: 'PDF'
        },

        {
            extend: 'print',
            text: 'Imprimir',
            autoPrint: true
        }
    ],
} );
} );

$(document).ready(function() {
var oTable = $('#example').dataTable();

// Highlight every second row
oTable.$('oOpts.order=current');
} );



</script>

<style>

table.dataTable thead>tr>th.sorting_asc, table.dataTable thead>tr>th.sorting_desc, table.dataTable thead>tr>th.sorting, table.dataTable thead>tr>td.sorting_asc, table.dataTable thead>tr>td.sorting_desc, table.dataTable thead>tr>td.sorting {
    padding: 10px;
    opacity: 0; }

  table.dataTable.no-footer {
    border-bottom:1px solid #d8dbe0; }

    .dataTables_filter {
      display: none; }


.table-bordered, .table-bordered td, .table-bordered th {
border: 1px solid;
border-color: #ffffff;
}


input.chk {
    margin: 10px;
    width: 50px;
    height: 16px;
}

td {
    width: 50%;
}

th.imag {
    background-color: white;
}

td.imag {
    background-color: white;
}

a {
    text-decoration: none;
    background-color: transparent;
    color: #545456;
}

</style>

@endsection
