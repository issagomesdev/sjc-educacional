@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Visualizar Livros
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cadastrar-livros.index') }}">
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
                            {{ trans('cruds.cadastrarLivro.fields.id') }}
                        </th>
                        <td>
                            {{ $cadastrarLivro->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.titulo') }}
                        </th>
                        <td>
                            {{ $cadastrarLivro->titulo ?? 'Não atribuído' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.autor') }}
                        </th>
                        <td>
                            {{ $cadastrarLivro->autor ?? 'Não atribuído' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.idioma') }}
                        </th>
                        <td>
                            {{ $cadastrarLivro->idioma ?? 'Não atribuído' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.biblioteca') }}
                        </th>
                        <td>
                            {{ $cadastrarLivro->biblioteca->nome_da_biblioteca ?? 'Não atribuído' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.ano') }}
                        </th>
                        <td>
                            {{ $cadastrarLivro->ano ?? 'Não atribuído' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.editora') }}
                        </th>
                        <td>
                            {{ $cadastrarLivro->editora ?? 'Não atribuído' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.genero') }}
                        </th>
                        <td>
                            {{ App\Models\CadastrarLivro::GENERO_SELECT[$cadastrarLivro->genero] ?? 'Não atribuído' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.assunto') }}
                        </th>
                        <td>
                            {{ $cadastrarLivro->assunto ?? 'Não atribuído' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.materias_relacionadas') }}
                        </th>
                        <td>
                            @foreach($cadastrarLivro->materias_relacionadas as $key => $materias_relacionadas)
                                <span class="label label-info">{{ $materias_relacionadas->nome_da_materia ?? 'Não atribuído' }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.exemplares_existentes') }}
                        </th>
                        <td>
                            {{ $cadastrarLivro->exemplares_existentes ?? 'Não atribuído' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Exemplares Disponiveis
                        </th>
                        <td>
                            {{ $exemplaresDisponiveis }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.isbn') }}
                        </th>
                        <td>
                            {{ $cadastrarLivro->isbn ?? 'Não atribuído' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarLivro.fields.cdd') }}
                        </th>
                        <td>
                            {{ $cadastrarLivro->cdd ?? 'Não atribuído' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Disponibilidade
                        </th>
                        <td>
                            {{ App\Models\CadastrarLivro::SELECIONE_RADIO[$cadastrarLivro->selecione] ?? 'Não atribuído' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Por:
                        </th>
                        <td>
                            {{ $cadastrarLivro->assinatura->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            De:
                        </th>
                        <td>
                            {{ $cadastrarLivro->team->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Criado em
                        </th>
                        <td>
                            {{ $cadastrarLivro->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                           Atualizado em
                        </th>
                        <td>
                            {{ $cadastrarLivro->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cadastrar-livros.index') }}">
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
