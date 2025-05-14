@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Visualizar Empréstimo de Livro
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.emprestimos-e-devolucos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table id="example" class="table table-striped table-hover table-bordered">
              <thead>
                  <tr>
                    <th class="sorting sorting_desc" tabindex="0" aria-controls="export" rowspan="1" colspan="1" aria-label=" " style="width: 20%;" aria-sort="none"> </th>
                    <th class="sorting sorting_desc" tabindex="0" aria-controls="export" rowspan="1" colspan="1" aria-label=" " style="width: 80%;" aria-sort="none"> </th>
                  </tr>
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.emprestimosEDevoluco.fields.id') }}
                        </th>
                        <td>
                            {{ $emprestimosEDevoluco->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.emprestimosEDevoluco.fields.usuario_da_biblioteca') }}
                        </th>
                        <td>
                            {{ $emprestimosEDevoluco->usuario_da_biblioteca->nome_completo ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.emprestimosEDevoluco.fields.biblioteca') }}
                        </th>
                        <td>
                            {{ $emprestimosEDevoluco->biblioteca->nome_da_biblioteca ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.emprestimosEDevoluco.fields.livros') }}
                        </th>
                        <td>
                            @foreach($emprestimosEDevoluco->livros as $key => $livros)
                                <span class="label label-info">{{ $livros->titulo }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.emprestimosEDevoluco.fields.data_de_devolucao') }}
                        </th>
                        <td>
                            {{ $emprestimosEDevoluco->data_de_devolucao }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Situação
                        </th>
                        <td>
                            {{ App\Models\EmprestimosEDevoluco::SITUACAO_SELECT[$emprestimosEDevoluco->situacao] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Por
                        </th>
                        <td>
                            {{ $emprestimosEDevoluco->assinatura->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            De
                        </th>
                        <td>
                            {{ $emprestimosEDevoluco->team->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Criado em
                        </th>
                        <td>
                            {{ $emprestimosEDevoluco->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Atualizado em
                        </th>
                        <td>
                            {{ $emprestimosEDevoluco->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.emprestimos-e-devolucos.index') }}">
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
