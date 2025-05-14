@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Visualizar Projeto
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.banco-de-projetos.index') }}">
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
                            {{ trans('cruds.bancoDeProjeto.fields.id') }}
                        </th>
                        <td>
                            {{ $bancoDeProjeto->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bancoDeProjeto.fields.titulo') }}
                        </th>
                        <td>
                            {{ $bancoDeProjeto->titulo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bancoDeProjeto.fields.resumo') }}
                        </th>
                        <td>
                            {!! $bancoDeProjeto->resumo !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bancoDeProjeto.fields.autor') }}
                        </th>
                        <td>
                            {{ $bancoDeProjeto->autor }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bancoDeProjeto.fields.publico_alvo') }}
                        </th>
                        <td>
                            {{ App\Models\BancoDeProjeto::PUBLICO_ALVO_SELECT[$bancoDeProjeto->publico_alvo] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bancoDeProjeto.fields.area_de_conhecimento') }}
                        </th>
                        <td>
                            @foreach($bancoDeProjeto->area_de_conhecimentos as $key => $area_de_conhecimento)
                                <span class="label label-info">{{ $area_de_conhecimento->nome_da_materia }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bancoDeProjeto.fields.objetivo') }}
                        </th>
                        <td>
                            {!! $bancoDeProjeto->objetivo !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bancoDeProjeto.fields.metodologia') }}
                        </th>
                        <td>
                            {{ $bancoDeProjeto->metodologia }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bancoDeProjeto.fields.finalidade') }}
                        </th>
                        <td>
                            {{ $bancoDeProjeto->finalidade }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Situação da Proposta
                        </th>
                        <td>
                            {{ App\Models\BancoDeProjeto::SITUACAO_DO_PROJETO_SELECT[$bancoDeProjeto->situacao_do_projeto] ?? '' }}
                        </td>
                    </tr>
                      @if($bancoDeProjeto->situacao_do_projeto == 7)
                    <tr>
                        <th>
                            Sugestão
                        </th>
                        <td>
                            {{ $bancoDeProjeto->sugestao }}
                        </td>
                    </tr>
                     @endif
                     <tr>
                         <th>
                             Por:
                         </th>
                         <td>
                             {{ $bancoDeProjeto->assinatura->name ?? '' }}
                         </td>
                     </tr>
                    <tr>
                        <th>
                            De:
                        </th>
                        <td>
                            {{ $bancoDeProjeto->team->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Criado em
                        </th>
                        <td>
                            {{ $bancoDeProjeto->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Atualizado em
                        </th>
                        <td>
                            {{ $bancoDeProjeto->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.banco-de-projetos.index') }}">
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
