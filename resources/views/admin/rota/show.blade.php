@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Visualizar Rota
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.rota.index') }}">
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
                            {{ trans('cruds.rotum.fields.id') }}
                        </th>
                        <td>
                            {{ $rotum->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rotum.fields.ano') }}
                        </th>
                        <td>
                            {{ $rotum->ano }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rotum.fields.descricao') }}
                        </th>
                        <td>
                            {!! $rotum->descricao !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rotum.fields.horario_de_saida') }}
                        </th>
                        <td>
                            {{ $rotum->horario_de_saida }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rotum.fields.origem') }}
                        </th>
                        <td>
                            {{ $rotum->origem }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rotum.fields.horario_de_destino') }}
                        </th>
                        <td>
                            {{ $rotum->horario_de_destino }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rotum.fields.destino') }}
                        </th>
                        <td>
                            {{ $rotum->destino }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rotum.fields.quilometros_percorridos') }}
                        </th>
                        <td>
                            {{ $rotum->quilometros_percorridos }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rotum.fields.veiculo_responsavel') }}
                        </th>
                        <td>
                            {{ $rotum->veiculo_responsavel->descricao ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rotum.fields.motorista_responsavel') }}
                        </th>
                        <td>
                            {{ $rotum->motorista_responsavel->nome_completo ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Alunos na rota
                        </th>
                        <td>
                           <ul id=stocksymbols>
                             @foreach($alunos as $alunos)
                             <li> <a href="{{ route('admin.cadastros.show', $alunos->id) }}"> {{ $alunos->nome_completo }}, </a> </li>
                             @endforeach
                           </ul>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Por:
                        </th>
                        <td>
                            {{ $rotum->assinatura->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            De:
                        </th>
                        <td>
                            {{ $rotum->team->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Criado em
                        </th>
                        <td>
                            {{ $rotum->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Atualizar em
                        </th>
                        <td>
                            {{ $rotum->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.rota.index') }}">
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
            <a class="nav-link" href="#rota_percorrida_cadastros" role="tab" data-toggle="tab">
                {{ trans('cruds.cadastro.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="rota_percorrida_cadastros">
            @includeIf('admin.rota.relationships.rotaPercorridaCadastros', ['cadastros' => $rotum->rotaPercorridaCadastros])
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

function sortList(ul) {
  var ul = document.getElementById(ul);

  Array.from(ul.getElementsByTagName("LI"))
    .sort((a, b) => a.textContent.localeCompare(b.textContent))
    .forEach(li => ul.appendChild(li));
}

sortList("stocksymbols");

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

a {
    text-decoration: none;
    background-color: transparent;
    color: #545456;
}

li {
    list-style: auto;
}

</style>

@endsection
