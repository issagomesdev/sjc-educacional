<div class="sidebar-div">
<div class="sidebar" data-ativo="close">

    <div class="nav-div">
    <ul class="nav-links">
      <div class="logo-details">
        <div class="logo" > <img class="logo" src="{{ url('site/images/logo.png') }}" alt="sjcsistemas" width="70px" height="auto"> </div>
        <span class="logo_name">SJC Educacional</span>
      </div>

      <li>
        <a href="{{ route("admin.home") }}">
          <i class='fas fa-home c-sidebar-nav-icon'></i>
          <span class="link_name">Home</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="{{ route("admin.home") }}">Home</a></li>
        </ul>
      </li>

   @can('user_alert_access')
        <li>
          <a href="{{ route("admin.user-alerts.index") }}">
            <i class='fa-fw fas fa-bell c-sidebar-nav-icon' ></i>
            <span class="link_name">Comunicados</span>
          </a>
          <ul class="sub-menu blank">
            <li><a class="link_name" href="{{ route("admin.user-alerts.index") }}">Comunicados</a></li>
          </ul>
        </li>
    @endcan

    @can('abrir_e_encerrar_ano_letivo_access')
    <li>
      <a href="{{ route("admin.abrir-e-encerrar-ano-letivos.index") }}">
        <i class='fa-fw fas fa-unlock-alt c-sidebar-nav-icon' ></i>
        <span class="link_name"> Abrir/Encerrar <br> Ano Letivo </span>
      </a>
      <ul class="sub-menu blank">
        <li><a class="link_name" href="{{ route("admin.abrir-e-encerrar-ano-letivos.index") }}"> Abrir/Encerrar Ano Letivo </a></li>
      </ul>
    </li>
    @endcan

    @can('reports_access')
      <li>
        <div class="iocn-link">
          <a>
            <i class='fas fa-chart-bar c-sidebar-nav-icon' ></i>
            <span class="link_name">Relatórios</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name"> Relatórios </a></li>
          <li><a href="{{ route("admin.reports") }}"> Página Inicial </a></li>
          <li><a href="{{ route("admin.reports.usuarios") }}"> Usuários </a></li>
          <li><a href="{{ route("admin.reports.teams") }}?type=all&localizacao=all&estado=all&situacao=all&administracao=all"> Instituições </a></li>
          <li><a href="{{ route("admin.reports.profissionais") }}?genero=all&localizacao=all&estado=all&situacao=all&funcao=all&instituicao=all"> Profissionais </a></li>
          <li><a href="{{ route("admin.reports.estudantes") }}?escola=all&serie=all&genero=all&situacao=all&localizacao=all&estado=all"> Estudantes </a></li>
          <li><a href="{{ route("admin.reports.turmas") }}?escola=all&tipo=all&nivel=all&turno=all&serie=all"> Turmas </a></li>
          <li><a href="{{ route("admin.reports.desempenho") }}?escola=all&ano=all&turno=all&nivel=all&disciplina=all&serie=all"> Desempenho </a></li>
        </ul>
      </li>
      @endcan
      @can('user_management_access')
        <li>
          <div class="iocn-link">
            <a>
              <i class='fa-fw fas fa-users-cog c-sidebar-nav-icon' ></i>
              <span class="link_name"> Gestão da <br> Secretaria </span>
            </a>
            <i class='bx bxs-chevron-down arrow' ></i>
          </div>
          <ul class="sub-menu">
            @can('user_management_access') <li> <a class="link_name"> Gestão da Secretaria </a></li> @endcan
            @can('user_access') <li><a href="{{ route("admin.users.index") }}"> Usuários </a> </li> @endcan
            @can('permission_access') <li> <a href="{{ route("admin.permissions.index") }}"> Permissões </a></li> @endcan
            @can('type_access') <li><a href="{{ route("admin.types.index") }}"> Tipo de Acesso </a></li> @endcan
            @can('role_access') <li><a href="{{ route("admin.roles.index") }}"> Grupo de Usuários </a></li> @endcan
            @can('team_access') <li><a href="{{ route("admin.teams.index") }}"> Instituições </a></li> @endcan
            @can('team_type_access') <li><a href="{{ route("admin.team-types.index") }}"> Tipos de Instituição </a></li> @endcan
            @can('profissional_access') <li><a href="{{ route("admin.profissionais.index") }}"> Profissionais </a></li> @endcan
            @can('tipo_de_profissional_access') <li><a href="{{ route("admin.tipo-de-profissionals.index") }}"> Tipos de Profissionais </a></li> @endcan
            @can('instalar_access') <li><a href="{{ route("admin.instalars.index") }}"> Instalar Profissionais </a></li> @endcan
            @can('deslocar_access') <li><a href="{{ route("admin.deslocars.index") }}"> Deslocar Profissionais </a></li> @endcan
            @can('audit_log_access') <li><a href="{{ route("admin.audit-logs.index") }}"> Auditoria </a></li> @endcan
          </ul>
        </li>
        @endcan
        @can('gestao_escolar_access')
          <li>
            <div class="iocn-link">
              <a>
                <i class='fa fa-graduation-cap c-sidebar-nav-icon' ></i>
                <span class="link_name"> Gestão <br> Escolar </span>
              </a>
              <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
              @can('gestao_escolar_access') <li> <a class="link_name"> Gestão Escolar </a></li> @endcan
              @can('cadastro_access') <li> <a href="{{ route("admin.cadastros.index") }}"> Estudantes </a></li> @endcan
              @can('matricula_access') <li> <a href="{{ route("admin.enturmacao.index") }}"> Enturmação </a></li> @endcan
              @can('transferencium_access') <li> <a href="{{ route("admin.transferencia.index") }}"> Transferências </a></li> @endcan
              @can('rematricula_access') <li> <a href="{{ route("admin.rematriculas.index") }}"> Rematrículas </a></li> @endcan
              @can('turma_access') <li><a href="{{ route("admin.turmas.index") }}"> Turmas </a></li> @endcan
              @can('vaga_access') <li><a href="{{ route("admin.vagas.index") }}"> Vagas </a></li> @endcan
              @can('dispensa_access') <li><a href="{{ route("admin.dispensas.index") }}"> Dispensas </a></li> @endcan
              @can('semaula_access') <li><a href="{{ route("admin.semaulas.index") }}"> Suspender Aulas </a></li> @endcan
              @can('documento_access') <li><a href="{{ route("admin.documentos.index") }}"> Documentos </a></li> @endcan
            </ul>
          </li>
          @endcan
          @can('diario_de_classe_access')
            <li>
              <div class="iocn-link">
                <a>
                  <i class='fas fa-feather-alt' ></i>
                  <span class="link_name"> Diário de <br> Classe </span>
                </a>
                <i class='bx bxs-chevron-down arrow' ></i>
              </div>
              <ul class="sub-menu">
                @can('diario_de_classe_access') <li> <a class="link_name"> Diário de Classe </a></li> @endcan
                @can('presenca_eletiva_access') <li> <a href="{{ route("admin.presenca-eletivas.index") }}"> Presença Eletiva </a></li> @endcan
                @can('notum_access') <li> <a href="{{ route("admin.nota.index") }}"> Notas </a></li> @endcan
                @can('desempenho_access') <li><a href="{{ route("admin.desempenhos.index") }}"> Desempenho </a></li> @endcan
                @can('conteudos_curriculare_access') <li><a href="{{ route("admin.conteudos-curriculares.index") }}"> Conteudos Curriculares </a></li> @endcan
                @can('bncc_access') <li><a href="{{ route("admin.bnccs.index") }}"> BNCC </a></li> @endcan
                @can('curriculo_de_pernambuco_access') <li><a href="{{ route("admin.curriculo-de-pernambucos.index") }}"> Currículo de Pernambuco </a></li> @endcan
                @can('planejamento_bimestral_access') <li><a href="{{ route("admin.planejamento-bimestrals.index") }}"> Planejamento Bimestral </a></li> @endcan
                @can('propostas_de_aula_access') <li><a href="{{ route("admin.aulas.propostas") }}"> Propostas de Aulas </a> </li> @endcan
                @can('banco_de_aula_access') <li><a href="{{ route("admin.banco-de-aulas.index") }}"> Banco De Aulas </a></li> @endcan
              </ul>
            </li>
            @endcan
            @can('materium_access')
            <li>
            <a href="{{ route("admin.materia.index") }}">
            <i class='fas fa-chalkboard-teacher' ></i>
            <span class="link_name"> Disciplinas </span>
            </a>
            <ul class="sub-menu blank">
            <li><a class="link_name" href="{{ route("admin.materia.index") }}"> Disciplinas </a></li>
            </ul>
            </li>
            @endcan
            @can('quadro_de_horario_access')
            <li>
              <a href="{{ route("admin.quadro-de-horarios.index") }}">
                <i class='fas fa-clock' ></i>
                <span class="link_name"> Quadro de <br> Horários </span>
              </a>
              <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route("admin.quadro-de-horarios.index") }}"> Quadro De Horários </a></li>
              </ul>
            </li>
            @endcan
            @can('boletin_access')
            <li>
              <a href="{{ route("admin.boletins.index") }}">
                <i class="fas fa-scroll"></i>
                <span class="link_name"> Boletins </span>
              </a>
              <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route("admin.boletins.index") }}"> Boletins </a></li>
              </ul>
            </li>
            @endcan
            @can('transporte_escolar_access')
              <li>
                <div class="iocn-link">
                  <a>
                    <i class="fas fa-bus"></i>
                    <span class="link_name"> Transporte <br> Escolar </span>
                  </a>
                  <i class='bx bxs-chevron-down arrow' ></i>
                </div>
                <ul class="sub-menu">
                  @can('transporte_escolar_access') <li> <a class="link_name"> Transporte Escolar </a></li> @endcan
                  @can('cadastrarveiculo_access') <li> <a href="{{ route("admin.cadastrarveiculos.index") }}"> Veículos </a></li> @endcan
                  @can('cadastrar_motoristum_access') <li> <a href="{{ route("admin.cadastrar-motorista.index") }}"> Motoristas </a></li> @endcan
                  @can('rotum_access') <li><a href="{{ route("admin.rota.index") }}"> Rotas </a></li> @endcan
                </ul>
              </li>
              @endcan

              @can('biblioteca_access')
                <li>
                  <div class="iocn-link">
                    <a>
                      <i class="fas fa-book"></i>
                      <span class="link_name"> Bibliotecas  </span>
                    </a>
                    <i class='bx bxs-chevron-down arrow' ></i>
                  </div>
                  <ul class="sub-menu">
                    @can('biblioteca_access') <li> <a class="link_name"> Bibliotecas </a></li> @endcan
                    @can('cadastrar_biblioteca_access') <li> <a href="{{ route("admin.cadastrar-bibliotecas.index") }}"> Unidades </a></li> @endcan
                    @can('cadastrar_livro_access') <li> <a href="{{ route("admin.cadastrar-livros.index") }}"> Livros </a></li> @endcan
                    @can('usuarios_da_biblioteca_access') <li> <a href="{{ route("admin.usuarios-da-bibliotecas.index") }}"> Usuários Da Biblioteca </a></li> @endcan
                    @can('emprestimos_e_devoluco_access') <li> <a href="{{ route("admin.emprestimos-e-devolucos.index") }}"> Empréstimos e Devoluções </a></li> @endcan
                    @can('relatorios_da_biblioteca_access') <li> <a href="{{ route("admin.relatorios-da-bibliotecas.index") }}"> Relatórios Da Biblioteca </a></li> @endcan
                  </ul>
                </li>
                @endcan

                @can('almoxarifado_access')
                  <li>
                    <div class="iocn-link">
                      <a>
                        <i class="fas fa-warehouse"></i>
                        <span class="link_name"> Almoxarifado </span>
                      </a>
                      <i class='bx bxs-chevron-down arrow' ></i>
                    </div>

                    <ul class="sub-menu">

                      @can('cadastros_do_almoxarifado_access')
                      <ul class="sub-menu">
                        @can('cadastros_do_almoxarifado_access') <li class="dec-menu"> <a class="link_name sub"> Cadastros </a></li> @endcan
                        @can('fornecedore_access') <li> <a href="{{ route("admin.fornecedores.index") }}"> Fornecedores </a></li> @endcan
                        @can('requisitante_access') <li> <a href="{{ route("admin.requisitantes.index") }}"> Requisitantes </a></li> @endcan
                        @can('estoque_access') <li> <a href="{{ route("admin.estoques.index") }}"> Estoques </a></li> @endcan
                        @can('categorias_de_produto_access') <li> <a href="{{ route("admin.categorias-de-produtos.index") }}">  Categorias De Produtos </a></li> @endcan
                        @can('produto_access') <li> <a href="{{ route("admin.produtos.index") }}"> Produtos </a></li> @endcan
                      </ul>
                      @endcan

                      @can('movimentacao_do_estoque_access')
                      <ul class="sub-menu">
                        @can('movimentacao_do_estoque_access') <li class="dec-menu"> <a class="link_name sub">  Movimentação Do Estoque </a></li> @endcan
                        @can('entrada_no_estoque_access') <li> <a href="{{ route("admin.entrada-no-estoques.index") }}">  Entrada no Estoque </a></li> @endcan
                        @can('saida_no_estoque_access') <li> <a href="{{ route("admin.saida-no-estoques.index") }}">  Saída No Estoque </a></li> @endcan
                      </ul>
                      @endcan

                        @can('requisico_access') <li> <a href="{{ route("admin.requisicos.index") }}"> Requisições </a></li> @endcan
                        @can('pedidos_de_compra_access') <li> <a href="{{ route("admin.pedidos-de-compras.index") }}">  Pedidos De Compra </a></li> @endcan
                        @can('relatorios_do_almoxarifado_access') <li> <a href="{{ route("admin.relatorios-do-almoxarifados.index") }}">  Relatorios Do Almoxarifado </a></li> @endcan


                        </ul>

                  </li>
                  @endcan

                @can('task_management_access')
                  <li>
                    <div class="iocn-link">
                      <a>
                        <i class="fas fa-calendar-plus"></i>
                        <span class="link_name"> Gerenciar <br> Calendário </span>
                      </a>
                      <i class='bx bxs-chevron-down arrow' ></i>
                    </div>
                    <ul class="sub-menu">
                      @can('task_management_access') <li> <a class="link_name"> Gerenciar Calendario </a></li> @endcan
                      @can('task_status_access') <li> <a href="{{ route("admin.task-statuses.index") }}"> Progressos </a></li> @endcan
                      @can('task_tag_access') <li> <a href="{{ route("admin.task-tags.index") }}"> Categorias </a></li> @endcan
                      @can('task_access') <li> <a href="{{ route("admin.tasks.index") }}"> Eventos </a></li> @endcan
                    </ul>
                  </li>
                  @endcan
                  @can('tasks_calendar_access')
                  <li>
                    <a href="{{ route("admin.tasks-calendars.index") }}">
                      <i class="fas fa-calendar-alt"></i>
                      <span class="link_name"> Calendário </span>
                    </a>
                    <ul class="sub-menu blank">
                      <li><a class="link_name" href="{{ route("admin.tasks-calendars.index") }}"> Calendário </a></li>
                    </ul>
                  </li>
                  @endcan
               </div>


    <div class="profile-details">
      <div class="profile-content" id="profile-edit">
        @if(auth()->user()->foto_de_perfil)
        <img src="{{ auth()->user()->foto_de_perfil->getUrl() }}" alt="profileImg">
        @else
        <img src="{{ url('null/nullphoto.png') }}" alt="profileImg">
        @endif
      </div>
      <div class="name-job">
        <div class="user-roles"> <div class="profile_name" style="overflow: hidden; text-overflow: ellipsis;"> {{Auth::user()->name}} </div> </div>
        <div class="job"> <div class="user-roles"> @foreach(Auth::user()->roles as $role) <span class="badge badge-info"> {{ $role->title }} </span> @endforeach </div> </div>
      </div>
      <a class="log-out" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();"> <i class='bx bx-log-out'> </i> </a>
    </div>
  </li>
</ul>
  </div>
  </div>

  @section('scripts') @parent <script> $('#profile-edit').click(function(){ window.location = "{{ route('profile.password.edit') }}"; }); </script> @endsection
  <style>

.sub {
      display: block !important;
      text-transform: uppercase;
  }

  .sidebar .nav-links li.dec-menu {
    list-style: disc;
}

  .container-fluid {
      margin-top: 12rem;
  }

  #profile-edit{
    cursor: pointer;
  }
  .user-roles {
    word-wrap: break-word;
    white-space: pre-wrap;
    width: 150px; }

    span.badge.badge-info {
    margin-bottom: 3px;
    margin-left: 2px;
}

.user-roles {
    display: flex;
    flex-wrap: wrap;
    word-wrap: break-word;
    white-space: pre-wrap;
    width: 110px;
}

.badge-info {
    color: #e9ecef;
    background-color: rgba(136, 230, 247, 0.5);
}
  </style>

  <link rel="stylesheet" href="{{ url('menu-drop/menu.css') }}">
  <link rel="stylesheet" href="{{ url('menu-drop/drop-menu.css') }}">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'
