@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Visualizar Biblioteca
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cadastrar-bibliotecas.index') }}">
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
                            {{ trans('cruds.cadastrarBiblioteca.fields.id') }}
                        </th>
                        <td>
                            {{ $cadastrarBiblioteca->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.nome_da_biblioteca') }}
                        </th>
                        <td>
                            {{ $cadastrarBiblioteca->nome_da_biblioteca }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.localizacao') }}
                        </th>
                        <td>
                            {{ App\Models\CadastrarBiblioteca::LOCALIZACAO_RADIO[$cadastrarBiblioteca->localizacao] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.estado') }}
                        </th>
                        <td>
                            {{ App\Models\CadastrarBiblioteca::ESTADO_SELECT[$cadastrarBiblioteca->estado] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.cidade') }}
                        </th>
                        <td>
                            {{ $cadastrarBiblioteca->cidade }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.bairro') }}
                        </th>
                        <td>
                            {{ $cadastrarBiblioteca->bairro }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.endereco') }}
                        </th>
                        <td>
                            {{ $cadastrarBiblioteca->endereco }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.domingo') }}
                        </th>
                        <td>
                          {{ App\Models\CadastrarBiblioteca::F_A[$cadastrarBiblioteca->domingo] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.horario_1') }}
                        </th>
                        <td>
                            {{ $cadastrarBiblioteca->horario_1 ?? 'Não disponível' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.horario_1_2') }}
                        </th>
                        <td>
                            {{ $cadastrarBiblioteca->horario_1_2 ?? 'Não disponível' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.segunda') }}
                        </th>
                        <td>
                            {{ App\Models\CadastrarBiblioteca::F_A[$cadastrarBiblioteca->segunda] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.horario_2') }}
                        </th>
                        <td>
                            {{ $cadastrarBiblioteca->horario_2 ?? 'Não disponível' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.horario_2_2') }}
                        </th>
                        <td>
                            {{ $cadastrarBiblioteca->horario_2_2 ?? 'Não disponível' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.terca_feira') }}
                        </th>
                        <td>
                            {{ App\Models\CadastrarBiblioteca::F_A[$cadastrarBiblioteca->terca_feira] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.horario_3') }}
                        </th>
                        <td>
                            {{ $cadastrarBiblioteca->horario_3 ?? 'Não disponível' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.horario_3_2') }}
                        </th>
                        <td>
                            {{ $cadastrarBiblioteca->horario_3_2 ?? 'Não disponível' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.quarta_feira') }}
                        </th>
                        <td>
                            {{ App\Models\CadastrarBiblioteca::F_A[$cadastrarBiblioteca->quarta_feira] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.horario_4') }}
                        </th>
                        <td>
                            {{ $cadastrarBiblioteca->horario_4 ?? 'Não disponível' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.horario_4_2') }}
                        </th>
                        <td>
                            {{ $cadastrarBiblioteca->horario_4_2 ?? 'Não disponível' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.quinta_feira') }}
                        </th>
                        <td>
                            {{ App\Models\CadastrarBiblioteca::F_A[$cadastrarBiblioteca->quinta_feira] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.horario_5') }}
                        </th>
                        <td>
                            {{ $cadastrarBiblioteca->horario_5 ?? 'Não disponível' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.horario_5_2') }}
                        </th>
                        <td>
                            {{ $cadastrarBiblioteca->horario_5_2 ?? 'Não disponível' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.sexta_feira') }}
                        </th>
                        <td>
                            {{ App\Models\CadastrarBiblioteca::F_A[$cadastrarBiblioteca->sexta_feira] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.horario_6') }}
                        </th>
                        <td>
                            {{ $cadastrarBiblioteca->horario_6 ?? 'Não disponível' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.horario_6_2') }}
                        </th>
                        <td>
                            {{ $cadastrarBiblioteca->horario_6_2 ?? 'Não disponível' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.sabado') }}
                        </th>
                        <td>
                            {{ App\Models\CadastrarBiblioteca::F_A[$cadastrarBiblioteca->sabado] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.horario_7') }}
                        </th>
                        <td>
                            {{ $cadastrarBiblioteca->horario_7 ?? 'Não disponível' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastrarBiblioteca.fields.horario_7_2') }}
                        </th>
                        <td>
                            {{ $cadastrarBiblioteca->horario_7_2 ?? 'Não disponível' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Por:
                        </th>
                        <td>
                            {{ $cadastrarBiblioteca->assinatura->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            De:
                        </th>
                        <td>
                            {{ $cadastrarBiblioteca->team->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Criado em
                        </th>
                        <td>
                            {{ $cadastrarBiblioteca->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Atualizado em
                        </th>
                        <td>
                            {{ $cadastrarBiblioteca->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cadastrar-bibliotecas.index') }}">
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
