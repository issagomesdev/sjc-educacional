@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.planejamentoBimestral.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.planejamento-bimestrals.index') }}">
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
                            {{ trans('cruds.planejamentoBimestral.fields.id') }}
                        </th>
                        <td>
                            {{ $planejamentoBimestral->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Status
                        </th>
                        <td>
                            {{ App\Models\PlanejamentoBimestral::STATUS_RADIO[$planejamentoBimestral->aulas_dadas] ?? 'Pendente de aprovação' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planejamentoBimestral.fields.disciplina') }}
                        </th>
                        <td>
                            {{ $planejamentoBimestral->disciplina->nome_da_materia ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planejamentoBimestral.fields.escola') }}
                        </th>
                        <td>
                            {{ $planejamentoBimestral->escola->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planejamentoBimestral.fields.turma') }}
                        </th>
                        <td>
                            {{ $planejamentoBimestral->turma->ano_serie ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planejamentoBimestral.fields.justificativa') }}
                        </th>
                        <td>
                            {!! $planejamentoBimestral->justificativa !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planejamentoBimestral.fields.objetivos') }}
                        </th>
                        <td>
                            {!! $planejamentoBimestral->objetivos !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planejamentoBimestral.fields.conteudos') }}
                        </th>
                        <td>
                            {!! $planejamentoBimestral->conteudos !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planejamentoBimestral.fields.procedimentos_metodologicos') }}
                        </th>
                        <td>
                            {!! $planejamentoBimestral->procedimentos_metodologicos !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planejamentoBimestral.fields.procedimentos_avaliativos') }}
                        </th>
                        <td>
                            {!! $planejamentoBimestral->procedimentos_avaliativos !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.planejamentoBimestral.fields.itinerario_formativo') }}
                        </th>
                        <td>
                            {!! $planejamentoBimestral->itinerario_formativo !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Situação
                        </th>
                        <td>
                            {{ App\Models\PlanejamentoBimestral::APROVAR_DESAPROVAR[$planejamentoBimestral->situacao] ?? 'Pendente' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Por:
                        </th>
                        <td>
                            {{ $planejamentoBimestral->assinatura->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            De:
                        </th>
                        <td>
                            {{ $planejamentoBimestral->team->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Criado em
                        </th>
                        <td>
                            {{ $planejamentoBimestral->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Atualizado em
                        </th>
                        <td>
                            {{ $planejamentoBimestral->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.planejamento-bimestrals.index') }}">
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
