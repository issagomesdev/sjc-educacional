@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Visualizar Currículo de Pernambuco
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.curriculo-de-pernambucos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>

            <table id="example" class="table table-striped table-hover table-bordered">
              <thead>
                  <tr>
                    <th class="sorting sorting_desc" tabindex="0" aria-controls="export" rowspan="1" colspan="1" aria-label=" " style="width: 30%;" aria-sort="none"> </th>
                    <th class="sorting sorting_desc" tabindex="0" aria-controls="export" rowspan="1" colspan="1" aria-label=" " style="width: 70%;" aria-sort="none"> </th>
                  </tr>
                <tbody>
                    <tr>
                        <th>
                            ID
                        </th>
                        <td>
                            {{ $curriculoDePernambuco->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Código
                        </th>
                        <td>
                            {{ $curriculoDePernambuco->codigo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                          Nível De Ensino
                        </th>
                        <td>
                            {{ $curriculoDePernambuco->nivel_de_ensino ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Séries
                        </th>
                        <td>
                          @foreach($series as $s)
                              <span class="label label-info">{{ $s->serie }}, </span>
                          @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Disciplina
                        </th>
                        <td>
                            {{ $curriculoDePernambuco->disciplina->nome_da_materia ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                          Objetivo e Habilidades
                        </th>
                        <td>
                            {{ $curriculoDePernambuco->objetivo_habilidade }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Objetivos de aprendizagem e desenvolvimento
                        </th>
                        <td>
                            {{ $curriculoDePernambuco->aprendizagem_desenvolvimento }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                          Unidade temática
                        </th>
                        <td>
                            {{ $curriculoDePernambuco->unidade_tematica }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Por:
                        </th>
                        <td>
                            {{ $curriculoDePernambuco->assinatura->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            De:
                        </th>
                        <td>
                            {{ $curriculoDePernambuco->team->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Criado em
                        </th>
                        <td>
                            {{ $curriculoDePernambuco->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Atualizado em
                        </th>
                        <td>
                            {{ $curriculoDePernambuco->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bnccs.index') }}">
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

th.imag {
    background-color: white;
}

td.imag {
    background-color: white;
}

</style>

@endsection
