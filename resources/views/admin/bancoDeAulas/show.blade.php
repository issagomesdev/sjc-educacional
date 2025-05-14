@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Visualizar Aula
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.banco-de-aulas.index') }}">
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
                            {{ trans('cruds.bancoDeAula.fields.id') }}
                        </th>
                        <td>
                            {{ $bancoDeAula->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bancoDeAula.fields.titulo') }}
                        </th>
                        <td>
                            {{ $bancoDeAula->titulo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bancoDeAula.fields.resumo') }}
                        </th>
                        <td>
                            {!! $bancoDeAula->resumo !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bancoDeAula.fields.autor') }}
                        </th>
                        <td>
                            {{ $bancoDeAula->autor }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bancoDeAula.fields.publico_alvo') }}
                        </th>
                        <td>
                            {{ App\Models\BancoDeAula::PUBLICO_ALVO_SELECT[$bancoDeAula->publico_alvo] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bancoDeAula.fields.area_de_conhecimento') }}
                        </th>
                        <td>
                            @foreach($bancoDeAula->area_de_conhecimentos as $key => $area_de_conhecimento)
                                <span class="label label-info">{{ $area_de_conhecimento->nome_da_materia }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bancoDeAula.fields.objetivo') }}
                        </th>
                        <td>
                            {!! $bancoDeAula->objetivo !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bancoDeAula.fields.metodologia') }}
                        </th>
                        <td>
                            {{ $bancoDeAula->metodologia }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bancoDeAula.fields.finalidade') }}
                        </th>
                        <td>
                            {{ $bancoDeAula->finalidade }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Situação da Proposta
                        </th>
                        <td>
                            {{ App\Models\BancoDeAula::SITUACAO_DO_PROJETO_SELECT[$bancoDeAula->situacao_do_projeto] ?? '' }}
                        </td>
                    </tr>
                      @if($bancoDeAula->situacao_do_projeto == 7)
                    <tr>
                        <th>
                            Sugestão
                        </th>
                        <td>
                            {{ $bancoDeAula->sugestao }}
                        </td>
                    </tr>
                     @endif
                    <tr>
                        <th>
                            Por:
                        </th>
                        <td>
                            {{ $bancoDeAula->assinatura->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            De:
                        </th>
                        <td>
                            {{ $bancoDeAula->team->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Criado em
                        </th>
                        <td>
                            {{ $bancoDeAula->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Atualizado em
                        </th>
                        <td>
                            {{ $bancoDeAula->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.banco-de-aulas.index') }}">
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
