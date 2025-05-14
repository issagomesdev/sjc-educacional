@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
      Visualizar Cadastro do Aluno
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cadastros.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <div class="pdf">
            <button onclick="getPDF()" class="down-pdf" id="downloadbtn"> Baixar Ficha </button>
            </div>
            <div class="canvas_div_pdf">
            <table id="example" class="table table-striped table-hover table-bordered">
              <thead>
                  <tr>
                    <th class="sorting sorting_desc" tabindex="0" aria-controls="export" rowspan="1" colspan="1" aria-label=" " style="width: 100%;" aria-sort="none"> </th>
                    <th class="sorting sorting_desc" tabindex="0" aria-controls="export" rowspan="1" colspan="1" aria-label=" " style="width: 100%;" aria-sort="none"> </th>
                  </tr>
                <tbody>
                  <tr>
                    <th class="imag">
                      @if($cadastro->foto_do_aluno)
                               <a class="pht" href="{{ $cadastro->foto_do_aluno->getUrl() }}" target="_blank" style="display: inline-block">
                                   <img src="{{ $cadastro->foto_do_aluno->getUrl() }}" style=" width: 200px; height: auto;">
                               </a>
                               @else
                               <a href="{{ url('null/nullphoto.png') }}" target="_blank" style="display: inline-block">
                                   <img src="{{ url('null/nullphoto.png') }}" style=" width: 200px; height: auto;">
                               </a>
                           @endif
                      </th>
                       <td class="imag"> </td>
                    </tr>
                    <tr>
                        <th>
                          Ano
                        </th>
                        <td>
                            {{ $cadastro->ano->ano ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Código de Cadastro
                        </th>
                        <td>
                            A{{ $cadastro->codigo_de_cadastro }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Código INEP
                        </th>
                        <td>
                            {{ $cadastro->codigo_do_inep }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.nome_completo') }}
                        </th>
                        <td>
                            {{ $cadastro->nome_completo ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.data_de_nascimento') }}
                        </th>
                        <td>
                            {{ $cadastro->data_de_nascimento  ?? 'Não Atribuido' }}/{{ $cadastro->ano_de_nascimento  ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.genero') }}
                        </th>
                        <td>
                            {{ App\Models\Cadastro::GENERO_RADIO[$cadastro->genero] ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.nacionalidade') }}
                        </th>
                        <td>
                            {{ $cadastro->nacionalidade ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.localizacao') }}
                        </th>
                        <td>
                            {{ App\Models\Cadastro::LOCALIZACAO_RADIO[$cadastro->localizacao] ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.estado') }}
                        </th>
                        <td>
                            {{ App\Models\Cadastro::ESTADO_SELECT[$cadastro->estado] ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.cidade') }}
                        </th>
                        <td>
                            {{ $cadastro->cidade ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.bairro') }}
                        </th>
                        <td>
                            {{ $cadastro->bairro ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.endereco') }}
                        </th>
                        <td>
                            {{ $cadastro->endereco ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            E-mail de usuário do aluno
                        </th>
                        <td>
                            {{ $cadastro->email_do_aluno->email ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.e_mail_de_contato') }}
                        </th>
                        <td>
                            {{ $cadastro->e_mail_de_contato ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.certidao_de_nascimento') }}
                        </th>
                        <td>
                            {{ $cadastro->certidao_de_nascimento ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.numero_do_nis') }}
                        </th>
                        <td>
                            {{ $cadastro->numero_do_nis ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.numero_do_cpf') }}
                        </th>
                        <td>
                            {{ $cadastro->numero_do_cpf ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.numero_da_identidade') }}
                        </th>
                        <td>
                            {{ $cadastro->numero_da_identidade ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.numero_de_telefone') }}
                        </th>
                        <td>
                            {{ $cadastro->numero_de_telefone ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.ocupacao_do_aluno') }}
                        </th>
                        <td>
                            {{ $cadastro->ocupacao_do_aluno ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.nome_responsavel') }}
                        </th>
                        <td>
                            {{ $cadastro->nome_responsavel ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.profissao_do_responsavel') }}
                        </th>
                        <td>
                            {{ $cadastro->profissao_do_responsavel ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.contato_de_emergencia') }}
                        </th>
                        <td>
                            {{ $cadastro->contato_de_emergencia ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.nome_do_responsavel_2') }}
                        </th>
                        <td>
                            {{ $cadastro->nome_do_responsavel_2 ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.profissao_do_responsavel_2') }}
                        </th>
                        <td>
                            {{ $cadastro->profissao_do_responsavel_2 ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.contato_de_emergencia_2') }}
                        </th>
                        <td>
                            {{ $cadastro->contato_de_emergencia_2 ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            E-mail de usuário dos responsaveis
                        </th>
                        <td>
                            {{ $cadastro->email_do_responsavel->email ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.cor_raca') }}
                        </th>
                        <td>
                            {{ App\Models\Cadastro::COR_RACA_SELECT[$cadastro->cor_raca] ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.tipo_sanguineo') }}
                        </th>
                        <td>
                            {{ $cadastro->tipo_sanguineo ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.problema_de_saude') }}
                        </th>
                        <td>
                            {{ App\Models\Cadastro::PROBLEMA_DE_SAUDE_RADIO[$cadastro->problema_de_saude] ?? 'Não' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.sesim_qual') }}
                        </th>
                        <td>
                            {{ $cadastro->sesim_qual ?? 'Não há problemas de saúde' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.algum_medicamento') }}
                        </th>
                        <td>
                            {{ App\Models\Cadastro::ALGUM_MEDICAMENTO_RADIO[$cadastro->algum_medicamento] ?? 'Não' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.sesim_qual_2') }}
                        </th>
                        <td>
                            {{ $cadastro->sesim_qual_2 ?? 'Não há uso de medicamentos' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.alguma_deficiencia') }}
                        </th>
                        <td>
                            {{ App\Models\Cadastro::ALGUMA_DEFICIENCIA_RADIO[$cadastro->alguma_deficiencia] ?? 'Não' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.sesim_qual_3') }}
                        </th>
                        <td>
                            {{ $cadastro->sesim_qual_3 ?? 'Não há Deficiências' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.alguma_alergia') }}
                        </th>
                        <td>
                            {{ App\Models\Cadastro::ALGUMA_ALERGIA_RADIO[$cadastro->alguma_alergia] ?? 'Não' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.sesim_qual_4') }}
                        </th>
                        <td>
                            {{ $cadastro->sesim_qual_4 ?? 'Não há Alergias' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.vai_a_escola') }}
                        </th>
                        <td>
                            {{ App\Models\Cadastro::VAI_A_ESCOLA_SELECT[$cadastro->vai_a_escola] ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    @if($cadastro->vai_a_escola == 'De Transporte Escolar')
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.rota_percorrida') }}
                        </th>
                        <td>
                        Veiculo deixa {{ $cadastro->rota_percorrida->origem ?? 'Não Atribuido' }} as {{ $cadastro->rota_percorrida->horario_de_saida ?? 'Não Atribuido' }} e tem previsão de chegar a {{ $cadastro->rota_percorrida->destino ?? 'Não Atribuido' }} as {{ $cadastro->rota_percorrida->horario_de_destino ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.programa_maiseduca') }}
                        </th>
                        <td>
                            {{ App\Models\Cadastro::PROGRAMA_MAISEDUCA_RADIO[$cadastro->programa_maiseduca] ?? 'Não' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.escola') }}
                        </th>
                        <td>
                            {{ $cadastro->escola->name ?? 'Não Atribuido' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.turma') }}
                        </th>
                        <td>
                            {{ $cadastro->turma->serie ?? 'Não Atribuido' }} {{ $cadastro->turma->identificacao ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cadastro.fields.arquivos_relacionados') }}
                        </th>
                        <td>
                          @if(is_countable($cadastro->arquivos_relacionados) && count($cadastro->arquivos_relacionados) > 0)
                          <ul>
                            @foreach($cadastro->arquivos_relacionados as $key => $media)
                              <li> <a href="{{ $media->getUrl() }}" target="_blank"> {{ $media->file_name }} </a> </li>
                            @endforeach
                            </ul>
                            @else
                            Não há arquivos relacionados a esse aluno
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Cadastrado em
                        </th>
                        <td>
                            {{ $cadastro->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Atualizado em
                        </th>
                        <td>
                            {{ $cadastro->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cadastros.index') }}">
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

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

<script type="text/javascript">

function getPDF(){

  var HTML_Width = $(".canvas_div_pdf").width();
  var HTML_Height = $(".canvas_div_pdf").height();
  var top_left_margin = 15;
  var PDF_Width = HTML_Width+(top_left_margin*2);
  var PDF_Height = (PDF_Width*1.5)+(top_left_margin*2);
  var canvas_image_width = HTML_Width;
  var canvas_image_height = HTML_Height;

  var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;


  html2canvas($(".canvas_div_pdf")[0],{allowTaint:true}).then(function(canvas) {
    canvas.getContext('2d');

    console.log(canvas.height+"  "+canvas.width);


    var imgData = canvas.toDataURL("image/jpeg", 1.0);
    var pdf = new jsPDF('p', 'pt',  [PDF_Width, PDF_Height]);
      pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);


    for (var i = 1; i <= totalPDFPages; i++) {
      pdf.addPage(PDF_Width, PDF_Height);
      pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
    }

      pdf.save("Ficha_{{ $cadastro->nome_completo }}.pdf");
      });
};

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

ul {
    list-style: none;
}

button#downloadbtn {
    position: relative;
    display: inline-block;
    box-sizing: border-box;
    margin-right: 0.333em;
    padding: 0.5em 1em;
    border: 1px solid #999;
    border-radius: 2px;
    cursor: pointer;
    font-size: 0.88em;
    color: black;
    white-space: nowrap;
    overflow: hidden;
    background-color: #e9e9e9;
    background-image: -webkit-linear-gradient(top, #fff 0%, #e9e9e9 100%);
    background-image: -moz-linear-gradient(top, #fff 0%, #e9e9e9 100%);
    background-image: -ms-linear-gradient(top, #fff 0%, #e9e9e9 100%);
    background-image: -o-linear-gradient(top, #fff 0%, #e9e9e9 100%);
    background-image: linear-gradient(to bottom, #fff 0%, #e9e9e9 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,StartColorStr='white', EndColorStr='#e9e9e9');
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    text-decoration: none;
    outline: none;
}



</style>

@endsection
