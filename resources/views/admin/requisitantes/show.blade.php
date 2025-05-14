@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Visualizar Requisitante
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.requisitantes.index') }}">
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
                            {{ trans('cruds.requisitante.fields.id') }}
                        </th>
                        <td>
                            {{ $requisitante->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.requisitante.fields.nome') }}
                        </th>
                        <td>
                            {{ $requisitante->nome }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.requisitante.fields.descricao') }}
                        </th>
                        <td>
                            {{ $requisitante->descricao }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.requisitante.fields.cep') }}
                        </th>
                        <td>
                            {{ $requisitante->cep }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.requisitante.fields.estado') }}
                        </th>
                        <td>
                            {{ App\Models\Requisitante::ESTADO_SELECT[$requisitante->estado] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.requisitante.fields.cidade') }}
                        </th>
                        <td>
                            {{ $requisitante->cidade }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.requisitante.fields.bairro') }}
                        </th>
                        <td>
                            {{ $requisitante->bairro }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.requisitante.fields.endereco') }}
                        </th>
                        <td>
                            {{ $requisitante->endereco }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.requisitante.fields.numero') }}
                        </th>
                        <td>
                            {{ $requisitante->numero }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.requisitante.fields.estoques') }}
                        </th>
                        <td>
                            @foreach($requisitante->estoques as $key => $estoques)
                                <span class="label label-info">{{ $estoques->titulo }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.requisitante.fields.situacao') }}
                        </th>
                        <td>
                            {{ App\Models\Requisitante::SITUACAO_SELECT[$requisitante->situacao] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Por
                        </th>
                        <td>
                            {{ $requisitante->assinatura->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            De
                        </th>
                        <td>
                            {{ $requisitante->team->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Criado em
                        </th>
                        <td>
                            {{ $requisitante->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Atualizado em
                        </th>
                        <td>
                            {{ $requisitante->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.requisitantes.index') }}">
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
