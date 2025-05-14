@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Declaração de Matrícula
    </div>

            <div class="card-body">
                <div class="form-group">
                    <div class="canvas_div_pdf">
                      <div class="card-body-y">
                      <table class=" table-log table-bordered table-striped table-hover datatable">
                          <thead>
                              <tr>
                              <th> {{ $cadastro->escola->name }}  </th>
                              </tr>
                          </thead>
                      </table>
                      </div>
                    <table class="table table-striped table-hover table-bordered">
                      <thead>
                          <tr>
                            <th class="sorting sorting_desc" tabindex="0" aria-controls="export" rowspan="1" colspan="1" aria-label=" " style="width: 100%;" aria-sort="none"> </th>
                          </tr>
                        <tbody>
                            <tr>
                                <td>
                                  Declaro, para os devidos fins, que <strong>{{ $cadastro->nome_completo }}</strong>, filho(a) de
                                  <strong>{{ $cadastro->nome_responsavel }}</strong> e de <strong>{{ $cadastro->nome_do_responsavel_2 }}</strong>
                                  , nascido em {{ $cadastro->data_de_nascimento }}/{{ $cadastro->ano_de_nascimento }}, cidade de {{ $cadastro->cidade }}
                                  , estado {{ $cadastro->estado }}, está matrículado neste estabelecimento de ensino, no {{ $cadastro->turma->serie }} do
                                  {{ $cadastro->turma->nivel_da_turma }}, turno da {{ $cadastro->turma->turno }}.

                                  <p> <p>  Declaro, ainda que o referido aluno frequenta normalmente as aulas até a presente data. </p>

                                  <p> <p>  {{ $data->cityName }} - {{ $data->regionCode }}, {{\Carbon\Carbon::now()->format('d M Y');}}</p>

                                  <p> <p>  Assinado por <strong>{{Auth::user()->name}}</strong> de <strong>{{Auth::user()->team->name}}</strong> </p>

                                </td>
                            </tr>
                            </tr>
                        </tbody>
                    </table>
                  </div>
                  <div class="pdf">
                  <button onclick="getPDF()" class="btn btn-pdf" id="downloadbtn"><i class="fa fa-download" aria-hidden="true"></i></button>
                  </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <a class="btn btn-default" href="{{ route('admin.cadastros.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

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

              pdf.save("declaracao_{{ $cadastro->nome_completo }}.pdf");
              });
        };

        </script>

        <style>

        a.btn.btn-default {
        color: #9fa1a2;
        background-color: #ffffff;
        border-color: #00000042;
        box-shadow: -3px 2px 1px 0px #00000052;
      }

      .table th {
      padding: 5px;
     }

        button#downloadbtn {
            color: #9fa1a2;
            background-color: #f2f2f300;
            border-color: #00000042;
            box-shadow: -3px 2px 1px 0px #00000052;
            margin-left: 95%;
        }

        .table-hover tbody tr:hover {
         background-color: rgb(255 255 255 / 8%); }

         .table-striped tbody tr:nth-of-type(odd) {
          background-color: rgb(255 255 255 / 5%); }

          table.dataTable.no-footer {
          border-bottom: 2px solid #d8dbe0; }

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
