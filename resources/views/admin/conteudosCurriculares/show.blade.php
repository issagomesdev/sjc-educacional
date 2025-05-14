@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Visualizar Conteudo Curricular
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.conteudos-curriculares.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table id="example" class="table table-striped table-hover table-bordered">
              <thead>
                  <tr>
                    <th class="sorting sorting_desc" tabindex="0" aria-controls="export" rowspan="1" colspan="1" aria-label=" " style="width: 30%;" aria-sort="none"> </th>
                    <th class="sorting sorting_desc" tabindex="0" aria-controls="export" rowspan="1" colspan="1" aria-label=" " style="width: 70%;" aria-sort="none"> </th>
                  </tr>
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.conteudosCurriculare.fields.id') }}
                        </th>
                        <td>
                            {{ $conteudosCurriculare->id }}
                        </td>
                    </tr>
                      <tr>
                          <th>
                              Base Curricular
                          </th>
                          <td>
                              {{ $conteudosCurriculare->bncc_x_cdp }}
                          </td>
                      </tr>
                      @if($conteudosCurriculare->bncc_x_cdp == 'BNCC')
                      <tr>
                          <th>
                              BNCC
                          </th>
                          <td>
                              {{ $conteudosCurriculare->bncc->codigo }} • {{ $conteudosCurriculare->bncc->nivel_de_ensino }} • {{ $conteudosCurriculare->bncc->disciplina->nome_da_materia ?? '' }}
                          </td>
                      </tr>
                      @endif
                      @if($conteudosCurriculare->bncc_x_cdp == 'CDP')
                      <tr>
                          <th>
                              Currículo de Pernambuco
                          </th>
                          <td>
                              {{ $conteudosCurriculare->cdp->codigo }} • {{ $conteudosCurriculare->cdp->nivel_de_ensino }} • {{ $conteudosCurriculare->cdp->disciplina->nome_da_materia ?? '' }}
                          </td>
                      </tr>
                      @endif
                      <tr>
                          <th>
                              Nivel de Ensino
                          </th>
                          <td>
                              {{ $conteudosCurriculare->nivel_de_ensino }}
                          </td>
                      </tr>
                      @if($conteudosCurriculare->nivel_de_ensino == 'Ensino Infantil') @else
                    <tr>
                        <th>
                            {{ trans('cruds.conteudosCurriculare.fields.disciplina') }}
                        </th>
                        <td>
                            {{ $conteudosCurriculare->disciplina->nome_da_materia ?? '' }}
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <th>
                            {{ trans('cruds.conteudosCurriculare.fields.bimestres') }}
                        </th>
                        <td>
                            {{ App\Models\ConteudosCurriculare::BIMESTRES_SELECT[$conteudosCurriculare->bimestres] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Séries
                        </th>
                        <td>
                          @foreach($series as $s)
                              <span class="label label-info">{{ $s->serie }}, </span>
                          @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.conteudosCurriculare.fields.campo_eixo') }}
                        </th>
                        <td>
                            {{ App\Models\ConteudosCurriculare::CAMPO_EIXO_SELECT[$conteudosCurriculare->campo_eixo] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.conteudosCurriculare.fields.conteudo') }}
                        </th>
                        <td>
                            {{ $conteudosCurriculare->conteudo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.conteudosCurriculare.fields.analises_linguisticas') }}
                        </th>
                        <td>
                            {{ $conteudosCurriculare->analises_linguisticas }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.conteudosCurriculare.fields.recurso_didatico') }}
                        </th>
                        <td>
                            {{ App\Models\ConteudosCurriculare::RECURSO_DIDATICO_SELECT[$conteudosCurriculare->recurso_didatico] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.conteudosCurriculare.fields.situacao_didatica') }}
                        </th>
                        <td>
                            {{ App\Models\ConteudosCurriculare::SITUACAO_DIDATICA_SELECT[$conteudosCurriculare->situacao_didatica] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                          Conteúdos Trabalhados
                        </th>
                        <td>
                            {!! $conteudosCurriculare->conteudos_trabalhados !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                          Complementos De Conteúdo
                        </th>
                        <td>
                            {!! $conteudosCurriculare->complementos_de_conteudo !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Por:
                        </th>
                        <td>
                            {{ $conteudosCurriculare->assinatura->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            De:
                        </th>
                        <td>
                            {{ $conteudosCurriculare->team->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Criado em
                        </th>
                        <td>
                            {{ $conteudosCurriculare->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Atualizado em
                        </th>
                        <td>
                            {{ $conteudosCurriculare->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.conteudos-curriculares.index') }}">
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
