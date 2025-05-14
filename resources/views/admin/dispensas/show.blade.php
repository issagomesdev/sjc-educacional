@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Visualizar Dispensa de Turma
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.dispensas.index') }}">
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
                            {{ trans('cruds.dispensa.fields.id') }}
                        </th>
                        <td>
                            {{ $dispensa->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dispensa.fields.ano') }}
                        </th>
                        <td>
                            {{ $dispensa->ano }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dispensa.fields.tipo_de_dispensa') }}
                        </th>
                        <td>
                            {{ App\Models\Dispensa::TIPO_DE_DISPENSA_RADIO[$dispensa->tipo_de_dispensa] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dispensa.fields.disciplinas') }}
                        </th>
                        <td>
                            @foreach($dispensa->disciplinas as $key => $disciplinas)
                                <span class="label label-info">{{ $disciplinas->nome_da_materia }},</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dispensa.fields.motivo') }}
                        </th>
                        <td>
                            {{ $dispensa->motivo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dispensa.fields.escola') }}
                        </th>
                        <td>
                          <a href="{{ route('admin.teams.show', $dispensa->escola->id) }}">  {{ $dispensa->escola->name ?? '' }} </a>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dispensa.fields.turma') }}
                        </th>
                        <td>
                          <a href="{{ route('admin.turmas.show', $dispensa->turma->id) }}">  {{ $dispensa->turma->serie ?? '' }} {{ $dispensa->turma->identificacao ?? '' }} </a>
                        </td>
                    </tr>
                    <tr>
                        <th>
                           {{ trans('cruds.dispensa.fields.alunos') }}
                        </th>
                        <td>
                            @foreach($dispensa->alunos as $key => $alunos)
                            <span class="label label-info">  <a href="{{ route('admin.cadastros.show', $alunos->id) }}">{{ $alunos->nome_completo }}</a>,</span> 
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dispensa.fields.bimestre_1') }}
                        </th>
                        <td>
                            {{ App\Models\Dispensa::BIMESTRE_RADIO[$dispensa->bimestre_1] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dispensa.fields.bimestre_2') }}
                        </th>
                        <td>
                            {{ App\Models\Dispensa::BIMESTRE_RADIO[$dispensa->bimestre_2] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dispensa.fields.bimestre_3') }}
                        </th>
                        <td>
                            {{ App\Models\Dispensa::BIMESTRE_RADIO[$dispensa->bimestre_3] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dispensa.fields.bimestre_4') }}
                        </th>
                        <td>
                            {{ App\Models\Dispensa::BIMESTRE_RADIO[$dispensa->bimestre_4] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Por:
                        </th>
                        <td>
                            {{ $dispensa->assinatura->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            De:
                        </th>
                        <td>
                            {{ $dispensa->team->name ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Criado em
                        </th>
                        <td>
                            {{ $dispensa->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Atualizado em
                        </th>
                        <td>
                            {{ $dispensa->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.dispensas.index') }}">
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
