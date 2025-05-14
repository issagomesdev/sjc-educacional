@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Visualizar Fornecedor
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fornecedores.index') }}">
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
                            {{ trans('cruds.fornecedore.fields.id') }}
                        </th>
                        <td>
                            {{ $fornecedore->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fornecedore.fields.razao') }}
                        </th>
                        <td>
                            {{ $fornecedore->razao }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fornecedore.fields.nome') }}
                        </th>
                        <td>
                            {{ $fornecedore->nome }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fornecedore.fields.cep') }}
                        </th>
                        <td>
                            {{ $fornecedore->cep }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fornecedore.fields.estado') }}
                        </th>
                        <td>
                            {{ $fornecedore->estado }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fornecedore.fields.cidade') }}
                        </th>
                        <td>
                            {{ $fornecedore->cidade }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fornecedore.fields.endereco') }}
                        </th>
                        <td>
                            {{ $fornecedore->endereco }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fornecedore.fields.numero') }}
                        </th>
                        <td>
                            {{ $fornecedore->numero }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fornecedore.fields.complemento') }}
                        </th>
                        <td>
                            {{ $fornecedore->complemento }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fornecedore.fields.bairro') }}
                        </th>
                        <td>
                            {{ $fornecedore->bairro }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fornecedore.fields.rg') }}
                        </th>
                        <td>
                            {{ $fornecedore->rg }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fornecedore.fields.telefone_1') }}
                        </th>
                        <td>
                            {{ $fornecedore->telefone_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fornecedore.fields.telefone_2') }}
                        </th>
                        <td>
                            {{ $fornecedore->telefone_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fornecedore.fields.contato') }}
                        </th>
                        <td>
                            {{ $fornecedore->contato }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fornecedore.fields.banco') }}
                        </th>
                        <td>
                            {{ $fornecedore->banco }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fornecedore.fields.agencia') }}
                        </th>
                        <td>
                            {{ $fornecedore->agencia }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fornecedore.fields.conta') }}
                        </th>
                        <td>
                            {{ $fornecedore->conta }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fornecedore.fields.email') }}
                        </th>
                        <td>
                            {{ $fornecedore->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fornecedore.fields.site') }}
                        </th>
                        <td>
                            {{ $fornecedore->site }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fornecedore.fields.observacoes') }}
                        </th>
                        <td>
                            {{ $fornecedore->observacoes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fornecedore.fields.situacao') }}
                        </th>
                        <td>
                            {{ App\Models\Fornecedore::SITUACAO_SELECT[$fornecedore->situacao] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Por
                        </th>
                        <td>
                            {{ $fornecedore->assinatura->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            De
                        </th>
                        <td>
                            {{ $fornecedore->team->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Criado em
                        </th>
                        <td>
                            {{ $fornecedore->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Atualizado em
                        </th>
                        <td>
                            {{ $fornecedore->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
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
