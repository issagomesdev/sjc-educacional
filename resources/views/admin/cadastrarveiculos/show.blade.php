@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Visualizar Veículo
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cadastrarveiculos.index') }}">
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
                            {{ trans('cruds.cadastrarveiculo.fields.id') }}
                        </th>
                        <td>
                            {{ $cadastrarveiculo->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarveiculo.fields.niv') }}
                        </th>
                        <td>
                            {{ $cadastrarveiculo->niv }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarveiculo.fields.placa') }}
                        </th>
                        <td>
                            {{ $cadastrarveiculo->placa }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarveiculo.fields.renavam') }}
                        </th>
                        <td>
                            {{ $cadastrarveiculo->renavam }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarveiculo.fields.marca') }}
                        </th>
                        <td>
                            {{ $cadastrarveiculo->marca }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarveiculo.fields.descricao') }}
                        </th>
                        <td>
                            {{ $cadastrarveiculo->descricao }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarveiculo.fields.instituicao') }}
                        </th>
                        <td>
                            {{ $cadastrarveiculo->instituicao->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarveiculo.fields.motorista_responsavel') }}
                        </th>
                        <td>
                            @foreach($cadastrarveiculo->motorista_responsavels as $key => $motorista_responsavel)
                                <span class="label label-info">{{ $motorista_responsavel->nome_completo }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarveiculo.fields.situacao') }}
                        </th>
                        <td>
                            {{ App\Models\Cadastrarveiculo::SITUACAO_SELECT[$cadastrarveiculo->situacao] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Por:
                        </th>
                        <td>
                            {{ $cadastrarveiculo->assinatura->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            De:
                        </th>
                        <td>
                            {{ $cadastrarveiculo->team->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Criado em
                        </th>
                        <td>
                            {{ $cadastrarveiculo->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Atualizado em
                        </th>
                        <td>
                            {{ $cadastrarveiculo->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cadastrarveiculos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#veiculo_responsavel_rota" role="tab" data-toggle="tab">
                {{ trans('cruds.rotum.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="veiculo_responsavel_rota">
            @includeIf('admin.cadastrarveiculos.relationships.veiculoResponsavelRota', ['rota' => $cadastrarveiculo->veiculoResponsavelRota])
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
