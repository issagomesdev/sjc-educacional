@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Visualizar Profissional
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.profissionais.index') }}">
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
                            {{ trans('cruds.profissionai.fields.id') }}
                        </th>
                        <td>
                            {{ $profissionai->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profissionai.fields.nome_completo') }}
                        </th>
                        <td>
                            {{ $profissionai->nome_completo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profissionai.fields.data_de_nascimento') }}
                        </th>
                        <td>
                            {{ $profissionai->data_de_nascimento }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profissionai.fields.genero') }}
                        </th>
                        <td>
                            {{ App\Models\Profissionai::GENERO_RADIO[$profissionai->genero] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Nome do Pai
                        </th>
                        <td>
                            {{ $profissionai->nome_do_pai	 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Nome da Mãe
                        </th>
                        <td>
                            {{ $profissionai->nome_da_mae	 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profissionai.fields.estado_civil') }}
                        </th>
                        <td>
                            {{ App\Models\Profissionai::ESTADO_CIVIL_SELECT[$profissionai->estado_civil] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Cadastro de Pessoa Física (CPF)
                        </th>
                        <td>
                            {{ $profissionai->cpf	 }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Registro Geral (RG)
                        </th>
                        <td>
                            {{ $profissionai->rg	 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profissionai.fields.localizacao') }}
                        </th>
                        <td>
                            {{ App\Models\Profissionai::LOCALIZACAO_RADIO[$profissionai->localizacao] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profissionai.fields.estado') }}
                        </th>
                        <td>
                            {{ App\Models\Profissionai::ESTADO_SELECT[$profissionai->estado] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profissionai.fields.cidade') }}
                        </th>
                        <td>
                            {{ $profissionai->cidade }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profissionai.fields.bairro') }}
                        </th>
                        <td>
                            {{ $profissionai->bairro }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profissionai.fields.endereco') }}
                        </th>
                        <td>
                            {{ $profissionai->endereco }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profissionai.fields.ano_de_contratacao') }}
                        </th>
                        <td>
                            {{ $profissionai->ano_de_contratacao }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profissionai.fields.situacao_de_contratacao') }}
                        </th>
                        <td>
                            {{ App\Models\Profissionai::SITUACAO_DE_CONTRATACAO_SELECT[$profissionai->situacao_de_contratacao] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profissionai.fields.escolaridade') }}
                        </th>
                        <td>
                            {{ App\Models\Profissionai::ESCOLARIDADE_SELECT[$profissionai->escolaridade] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profissionai.fields.ensino_medio_cursado') }}
                        </th>
                        <td>
                            {{ App\Models\Profissionai::ENSINO_MEDIO_CURSADO_SELECT[$profissionai->ensino_medio_cursado] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profissionai.fields.pos_concluidas') }}
                        </th>
                        <td>
                            {{ App\Models\Profissionai::POS_CONCLUIDAS_SELECT[$profissionai->pos_concluidas] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profissionai.fields.numero_de_contato') }}
                        </th>
                        <td>
                            {{ $profissionai->numero_de_contato }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profissionai.fields.e_mail_de_usuario') }}
                        </th>
                        <td>
                           <p> <a href="{{ route('admin.users.show', $profissionai->e_mail_de_usuario->id) }}"> {{ $profissionai->e_mail_de_usuario->email ?? '' }} </a> </p>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profissionai.fields.e_mail_de_contato') }}
                        </th>
                        <td>
                            {{ $profissionai->e_mail_de_contato }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Função
                        </th>
                        <td>
                            {{ $profissionai->type_id ?? 'Não atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profissionai.fields.instituicao') }}
                        </th>
                        <td>
                            {{ $profissionai->instituicao->name ?? 'Não atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profissionai.fields.arquivos_relacionados') }}
                        </th>
                        <td>
                            @foreach($profissionai->arquivos_relacionados as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                              Por:
                        </th>
                        <td>
                            {{ $profissionai->assinatura->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                              De:
                        </th>
                        <td>
                            {{ $profissionai->team->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Criado em
                        </th>
                        <td>
                            {{ $profissionai->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Atualizado em
                        </th>
                        <td>
                            {{ $profissionai->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.profissionais.index') }}">
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
            <a class="nav-link" href="#professor_quadro_de_horarios" role="tab" data-toggle="tab">
                {{ trans('cruds.quadroDeHorario.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="professor_quadro_de_horarios">
            @includeIf('admin.profissionais.relationships.professorQuadroDeHorarios', ['quadroDeHorarios' => $profissionai->professorQuadroDeHorarios])
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
