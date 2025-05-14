@extends('layouts.admin')
@section('content')

@if($transferencium->tipo_de_transferencia == 3)

<div class="card">
    <div class="card-header">
        Visualizar Transferência de Turma
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.transferencia.index') }}">
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
                            {{ trans('cruds.transferencium.fields.id') }}
                        </th>
                        <td>
                            {{ $transferencium->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Tipo de Transferência
                        </th>
                        <td>
                            {{ App\Models\Transferencium::TIPO_DE_TRANSFERENCIA[$transferencium->tipo_de_transferencia] }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transferencium.fields.ano') }}
                        </th>
                        <td>
                            {{ $transferencium->ano->ano }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Escola
                        </th>
                        <td>
                            {{ $transferencium->escola->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Turma Anterior
                        </th>
                        <td>
                            {{ $transferencium->old_turma->serie ?? '' }} {{ $transferencium->old_turma->identificacao ?? '' }} - {{ $transferencium->old_turma->nivel_da_turma ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Turma de Destino
                        </th>
                        <td>
                            {{ $transferencium->turma->serie ?? '' }} {{ $transferencium->turma->identificacao ?? '' }} - {{ $transferencium->turma->nivel_da_turma ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transferencium.fields.aluno') }}
                        </th>
                        <td>
                            {{ $transferencium->aluno->nome_completo }}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Por:
                        </th>
                        <td>
                            {{ $transferencium->assinatura->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            De:
                        </th>
                        <td>
                            {{ $transferencium->team->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Criado em
                        </th>
                        <td>
                            {{ $transferencium->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Atualizado em
                        </th>
                        <td>
                            {{ $transferencium->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
@endif

@if($transferencium->tipo_de_transferencia == 1)

<div class="card">
    <div class="card-header">
        Visualizar Transferência Interna
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.transferencia.index') }}">
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
                            {{ trans('cruds.transferencium.fields.id') }}
                        </th>
                        <td>
                            {{ $transferencium->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Tipo de Transferência
                        </th>
                        <td>
                            {{ App\Models\Transferencium::TIPO_DE_TRANSFERENCIA[$transferencium->tipo_de_transferencia] }}
                        </td>
                    </tr>
                </tbody>
            </table>
@endif

@if($transferencium->tipo_de_transferencia == 2)

<div class="card">
    <div class="card-header">
        Visualizar Transferência Externa
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.transferencia.index') }}">
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
                            {{ trans('cruds.transferencium.fields.id') }}
                        </th>
                        <td>
                            {{ $transferencium->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Tipo de Transferência
                        </th>
                        <td>
                            {{ App\Models\Transferencium::TIPO_DE_TRANSFERENCIA[$transferencium->tipo_de_transferencia] }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <a class="btn btn-xs btn-export" href="{{ route('admin.transferencia.export') }}?id={{ $transferencium->id }} ">
                Exportação
            </a>
@endif
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.transferencia.index') }}">
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

</style>

@endsection
