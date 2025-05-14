@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.produto.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.produtos.index') }}">
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
                            {{ trans('cruds.produto.fields.id') }}
                        </th>
                        <td>
                            {{ $produto->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.produto.fields.titulo') }}
                        </th>
                        <td>
                            {{ $produto->titulo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.produto.fields.unidade') }}
                        </th>
                        <td>
                            {{ $produto->unidade }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.produto.fields.categorias') }}
                        </th>
                        <td>
                            @foreach($produto->categorias as $key => $categorias)
                                <span class="label label-info">{{ $categorias->titulo }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.produto.fields.situacao') }}
                        </th>
                        <td>
                            {{ App\Models\Produto::SITUACAO_SELECT[$produto->situacao] ?? 'Ativo' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.produto.fields.consumivel') }}
                        </th>
                        <td>
                            {{ App\Models\Produto::CONSUMIVEL_SELECT[$produto->consumivel] ?? 'Não' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.produto.fields.estoque_minimo') }}
                        </th>
                        <td>
                            {{ $produto->estoque_minimo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.produto.fields.estoque_maximo') }}
                        </th>
                        <td>
                            {{ $produto->estoque_maximo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.produto.fields.localizacao') }}
                        </th>
                        <td>
                            {{ $produto->localizacao ?? 'Não atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Por
                        </th>
                        <td>
                            {{ $produto->assinatura->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            De
                        </th>
                        <td>
                            {{ $produto->team->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Criado em
                        </th>
                        <td>
                            {{ $produto->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Atualizado em
                        </th>
                        <td>
                            {{ $produto->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.produtos.index') }}">
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
