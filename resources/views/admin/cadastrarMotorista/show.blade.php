@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Visualizar Motorista
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cadastrar-motorista.index') }}">
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
                            {{ trans('cruds.cadastrarMotoristum.fields.id') }}
                        </th>
                        <td>
                            {{ $cadastrarMotoristum->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarMotoristum.fields.nome_completo') }}
                        </th>
                        <td>
                            {{ $cadastrarMotoristum->nome_completo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarMotoristum.fields.genero') }}
                        </th>
                        <td>
                            {{ App\Models\CadastrarMotoristum::GENERO_RADIO[$cadastrarMotoristum->genero] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarMotoristum.fields.data_de_nascimento') }}
                        </th>
                        <td>
                            {{ $cadastrarMotoristum->data_de_nascimento }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarMotoristum.fields.data_da_habilitacao') }}
                        </th>
                        <td>
                            {{ $cadastrarMotoristum->data_da_habilitacao }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarMotoristum.fields.vencimento_da_habilitacao') }}
                        </th>
                        <td>
                            {{ $cadastrarMotoristum->vencimento_da_habilitacao }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarMotoristum.fields.codigo_do_motorista') }}
                        </th>
                        <td>
                            {{ $cadastrarMotoristum->codigo_do_motorista }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarMotoristum.fields.cnh') }}
                        </th>
                        <td>
                            {{ $cadastrarMotoristum->cnh }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarMotoristum.fields.cpf') }}
                        </th>
                        <td>
                            {{ $cadastrarMotoristum->cpf }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarMotoristum.fields.rg') }}
                        </th>
                        <td>
                            {{ $cadastrarMotoristum->rg }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarMotoristum.fields.observacoes') }}
                        </th>
                        <td>
                            {!! $cadastrarMotoristum->observacoes !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarMotoristum.fields.localizacao') }}
                        </th>
                        <td>
                            {{ App\Models\CadastrarMotoristum::LOCALIZACAO_RADIO[$cadastrarMotoristum->localizacao] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarMotoristum.fields.estado') }}
                        </th>
                        <td>
                            {{ App\Models\CadastrarMotoristum::ESTADO_SELECT[$cadastrarMotoristum->estado] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarMotoristum.fields.cidade') }}
                        </th>
                        <td>
                            {{ $cadastrarMotoristum->cidade }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarMotoristum.fields.bairro') }}
                        </th>
                        <td>
                            {{ $cadastrarMotoristum->bairro }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarMotoristum.fields.endereco') }}
                        </th>
                        <td>
                            {{ $cadastrarMotoristum->endereco }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarMotoristum.fields.ano_de_contratacao') }}
                        </th>
                        <td>
                            {{ $cadastrarMotoristum->ano_de_contratacao }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarMotoristum.fields.situacao_de_contratacao') }}
                        </th>
                        <td>
                            {{ App\Models\CadastrarMotoristum::SITUACAO_DE_CONTRATACAO_SELECT[$cadastrarMotoristum->situacao_de_contratacao] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarMotoristum.fields.numero_de_telefone') }}
                        </th>
                        <td>
                            {{ $cadastrarMotoristum->numero_de_telefone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarMotoristum.fields.instituicao') }}
                        </th>
                        <td>
                            {{ $cadastrarMotoristum->instituicao->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Por:
                        </th>
                        <td>
                            {{ $cadastrarMotoristum->assinatura->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            De:
                        </th>
                        <td>
                            {{ $cadastrarMotoristum->team->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Criado em
                        </th>
                        <td>
                            {{ $cadastrarMotoristum->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Atualizado em
                        </th>
                        <td>
                            {{ $cadastrarMotoristum->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cadastrar-motorista.index') }}">
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
            <a class="nav-link" href="#motorista_responsavel_cadastrarveiculos" role="tab" data-toggle="tab">
                {{ trans('cruds.cadastrarveiculo.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="motorista_responsavel_cadastrarveiculos">
            @includeIf('admin.cadastrarMotorista.relationships.motoristaResponsavelCadastrarveiculos', ['cadastrarveiculos' => $cadastrarMotoristum->motoristaResponsavelCadastrarveiculos])
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
