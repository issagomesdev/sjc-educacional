@extends('layouts.admin')
    <title> Home </title>
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Bem-vindo ao SJC Educacional!
                </div>

                <div class="card-body card-login">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Você está logado!
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-home">
  <!-- home -->
<div class="container-size">
<div class="cards-icons">

@can('tasks_calendar_access')
  <div class="card-icons">
  <div class="card-body">
    <div class="card-icon">
    <a href="{{ route("admin.tasks-calendars.index") }}">
    <i class="icon fas fa-calendar-alt fa-5x" ></i>
    <div class="lab"> <span> Calendário </span> </div>
    </a>
    </div>
  </div>
  </div>
@endcan

@can('user_alert_access')
  <div class="card-icons">
    <div class="card-body">
      <div class="card-icon">
      <a href="{{ route("admin.user-alerts.index") }}">
      <i class="icon fas fa-bell fa-5x" ></i>
      <div class="lab"> <span> Comunicados </span> </div>
      </a>
      </div>
    </div>
    </div>
@endcan

@can('abrir_e_encerrar_ano_letivo_access')
      <div class="card-icons">
        <div class="card-body">
          <div class="card-icon">
          <a href="{{ route("admin.abrir-e-encerrar-ano-letivos.index") }}">
          <i class="icon fas fa-unlock-alt fa-5x" ></i>
          <div class="lab"> <span> Abrir/Encerrar Ano Letivo </span> </div>
          </a>
          </div>
        </div>
        </div>
@endcan

@can('materium_access')
        <div class="card-icons">
          <div class="card-body">
            <div class="card-icon">
            <a href="{{ route("admin.materia.index") }}">
            <i class="icon fas fa-chalkboard-teacher fa-5x" ></i>
            <div class="lab"> <span> Disciplinas </span> </div>
            </a>
            </div>
          </div>
          </div>
@endcan

@can('quadro_de_horario_access')
          <div class="card-icons">
            <div class="card-body">
              <div class="card-icon">
              <a href="{{ route("admin.quadro-de-horarios.index") }}">
              <i class="icon fas fa-clock fa-5x" ></i>
              <div class="lab"> <span> Quadro De Horários </span> </div>
              </a>
              </div>
            </div>
            </div>
@endcan

@can('boletin_access')
            <div class="card-icons">
              <div class="card-body">
                <div class="card-icon">
                <a href="{{ route("admin.boletins.index") }}">
                <i class="icon fas fa-scroll fa-5x"></i>
                <div class="lab"> <span> Boletins </span> </div>
                </a>
                </div>
              </div>
              </div>
@endcan

      </div>
      </div>

      <!-- Relatórios -->
@can('reports_access')
<div class="container-size">
<div class="card"> <div class="card-header"> Relatórios </div> </div>

<div class="cards-icons">
  <div class="card-icons">
    <div class="card-body">
      <div class="card-icon">
      <a href="{{ route("admin.reports.usuarios") }}">
      <i class="icon fas fa-user fa-5x" ></i>
      <div class="lab"> <span> Relatórios de Usuários </span> </div>
      </a>
      </div>
    </div>
    </div>


    <div class="card-icons">
      <div class="card-body">
        <div class="card-icon">
        <a href="{{ route("admin.reports.teams") }}?type=all&localizacao=all&estado=all&situacao=all&administracao=all">
        <i class="icon fas fa-school fa-5x" ></i>
        <div class="lab"> <span> Relatórios de Instituições </span> </div>
        </a>
        </div>
      </div>
      </div>

      <div class="card-icons">
        <div class="card-body">
          <div class="card-icon">
          <a href="{{ route("admin.reports.profissionais") }}?genero=all&localizacao=all&estado=all&situacao=all&funcao=all&instituicao=all">
          <i class="icon fas fa-user-tie fa-5x" ></i>
          <div class="lab"> <span> Relatórios de Profissionais </span> </div>
          </a>
          </div>
        </div>
        </div>

        <div class="card-icons">
          <div class="card-body">
            <div class="card-icon">
            <a href="{{ route("admin.reports.estudantes") }}?escola=all&serie=all&genero=all&situacao=all&localizacao=all&estado=all">
            <i class="icon fas fa-user-graduate fa-5x" ></i>
            <div class="lab"> <span> Relatórios de Estudantes </span> </div>
            </a>
            </div>
          </div>
          </div>

  <div class="card-icons">
    <div class="card-body">
      <div class="card-icon">
      <a href="{{ route("admin.reports.turmas") }}?escola=all&tipo=all&nivel=all&turno=all&serie=all">
      <i class="icon fas fa-user-friends fa-5x" ></i>
      <div class="lab"> <span> Relatórios de Turmas </span> </div>
      </a>
      </div>
    </div>
    </div>

    <div class="card-icons">
      <div class="card-body">
        <div class="card-icon">
        <a href="{{ route("admin.reports.desempenho") }}?escola=all&ano=all&turno=all&nivel=all&disciplina=all&serie=all">
        <i class="icon fas fa-chart-line fa-5x" ></i>
        <div class="lab"> <span> Relatórios de Desempenho </span> </div>
        </a>
        </div>
      </div>
      </div>

      </div>
      </div>
@endcan

      <!-- Gestão da Secretaria  -->
@can('user_management_access')
    <div class="container-size">
    <div class="card"> <div class="card-header"> Gestão da Secretaria </div> </div>
    <div class="cards-icons">

@can('user_access')

    <div class="card-icons">
      <div class="card-body">
        <div class="card-icon">
        <a href="{{ route("admin.users.index") }}">
        <i class="icon fas fa-user fa-5x" ></i>
        <div class="lab"> <span> Usuários </span> </div>
        </a>
        </div>
      </div>
      </div>
@endcan

@can('permission_access')

      <div class="card-icons">
        <div class="card-body">
          <div class="card-icon">
          <a href="{{ route("admin.permissions.index") }}">
          <i class="icon fas fa-unlock-alt fa-5x"></i>
          <div class="lab"> <span> Permissões </span> </div>
          </a>
          </div>
        </div>
        </div>
@endcan

@can('type_access')

          <div class="card-icons">
            <div class="card-body">
              <div class="card-icon">
              <a href="{{ route("admin.types.index") }}">
              <i class="icon fas fa-circle-exclamation fa-5x"></i>
              <div class="lab"> <span> Tipo de Acesso </span> </div>
              </a>
              </div>
            </div>
            </div>
@endcan

@can('role_access')

            <div class="card-icons">
              <div class="card-body">
                <div class="card-icon">
                <a href="{{ route("admin.roles.index") }}">
                <i class="icon fa fa-users fa-5x" ></i>
                <div class="lab"> <span> Grupo de Usuários </span> </div>
                </a>
                </div>
              </div>
              </div>

@endcan

@can('team_access')

            <div class="card-icons">
              <div class="card-body">
                <div class="card-icon">
                <a href="{{ route("admin.teams.index") }}">
                <i class="icon fas fa-school fa-5x" ></i>
                <div class="lab"> <span> Instituições </span> </div>
                </a>
                </div>
              </div>
              </div>
@endcan

@can('team_type_access')
              <div class="card-icons">
                <div class="card-body">
                  <div class="card-icon">
                  <a href="{{ route("admin.team-types.index") }}">
                  <i class="icon fas fa-tags fa-5x" ></i>
                  <div class="lab"> <span> Tipos de Instituição </span> </div>
                  </a>
                  </div>
                </div>
                </div>
@endcan

@can('profissional_access')

                  <div class="card-icons">
                    <div class="card-body">
                      <div class="card-icon">
                      <a href="{{ route("admin.profissionais.index") }}">
                      <i class="icon fas fa-user-tie fa-5x" ></i>
                      <div class="lab"> <span> Profissionais </span> </div>
                      </a>
                      </div>
                    </div>
                    </div>
@endcan

@can('tipo_de_profissional_access')

                    <div class="card-icons">
                      <div class="card-body">
                        <div class="card-icon">
                        <a href="{{ route("admin.tipo-de-profissionals.index") }}">
                        <i class="icon fas fa-user-tag fa-5x" ></i>
                        <div class="lab"> <span> Tipos de Profissionais </span> </div>
                        </a>
                        </div>
                      </div>
                      </div>
@endcan

@can('instalar_access')

        <div class="card-icons">
          <div class="card-body">
            <div class="card-icon">
              <a href="{{ route("admin.instalars.index") }}">
                <i class="icon fas fa-user-plus fa-5x"></i>
                <div class="lab"> <span> Instalar Profissionais </span> </div>
              </a>
            </div>
          </div>
        </div>
@endcan

@can('deslocar_access')

                      <div class="card-icons">
                        <div class="card-body">
                          <div class="card-icon">
                          <a href="{{ route("admin.deslocars.index") }}">
                          <i class="icon fas fa-user-minus fa-5x" ></i>
                          <div class="lab"> <span> Deslocar Profissionais </span> </div>
                          </a>
                          </div>
                        </div>
                        </div>
@endcan

@can('audit_log_access')
                    <div class="card-icons">
                      <div class="card-body">
                        <div class="card-icon">
                        <a href="{{ route("admin.audit-logs.index") }}">
                        <i class="icon fas fa-eye fa-5x"></i>
                        <div class="lab"> <span> Auditoria </span> </div>
                        </a>
                        </div>
                      </div>
                      </div>
@endcan

          </div>
          </div>
@endcan

          <!-- Gestão Escolar   -->
@can('gestao_escolar_access')

        <div class="container-size">
        <div class="card"> <div class="card-header"> Gestão Escolar </div> </div>
        <div class="cards-icons">

@can('cadastro_access')


          <div class="card-icons">
            <div class="card-body">
              <div class="card-icon">
              <a href="{{ route("admin.cadastros.index") }}">
              <i class="icon fas fa-user-graduate fa-5x" ></i>
              <div class="lab"> <span> Estudantes </span> </div>
              </a>
              </div>
            </div>
            </div>

@endcan

@can('matricula_access')

              <div class="card-icons">
                <div class="card-body">
                  <div class="card-icon">
                  <a href="{{ route("admin.enturmacao.index") }}">
                  <i class="icon fas fa-user-check fa-5x"></i>
                  <div class="lab"> <span> Enturmação </span> </div>
                  </a>
                  </div>
                </div>
                </div>

@endcan

@can('transferencium_access')

                  <div class="card-icons">
                    <div class="card-body">
                      <div class="card-icon">
                      <a href="{{ route("admin.transferencia.index") }}">
                      <i class="icon fas fa-exchange-alt fa-5x" ></i>
                      <div class="lab"> <span> Transferências </span> </div>
                      </a>
                      </div>
                    </div>
                    </div>

@endcan

@can('rematricula_access')

                      <div class="card-icons">
                        <div class="card-body">
                          <div class="card-icon">
                          <a href="{{ route("admin.rematriculas.index") }}">
                          <i class="icon fas fa-redo-alt fa-5x"></i>
                          <div class="lab"> <span> Rematrículas </span> </div>
                          </a>
                          </div>
                        </div>
                        </div>

@endcan

@can('turma_access')

              <div class="card-icons">
                <div class="card-body">
                  <div class="card-icon">
                  <a href="{{ route("admin.turmas.index") }}">
                  <i class="icon fas fa-user-friends fa-5x" ></i>
                  <div class="lab"> <span> Turmas </span> </div>
                  </a>
                  </div>
                </div>
                </div>

@endcan

@can('vaga_access')

                <div class="card-icons">
                  <div class="card-body">
                    <div class="card-icon">
                    <a href="{{ route("admin.vagas.index") }}">
                    <i class="icon fas fa-stamp fa-5x" ></i>
                    <div class="lab"> <span> Vagas </span> </div>
                    </a>
                    </div>
                  </div>
                  </div>

@endcan

@can('dispensa_access')

                  <div class="card-icons">
                    <div class="card-body">
                      <div class="card-icon">
                      <a href="{{ route("admin.dispensas.index") }}">
                      <i class="icon fas fa-ban fa-5x" ></i>
                      <div class="lab"> <span> Dispensas </span> </div>
                      </a>
                      </div>
                    </div>
                    </div>

@endcan

@can('semaula_access')

                    <div class="card-icons">
                      <div class="card-body">
                        <div class="card-icon">
                        <a href="{{ route("admin.semaulas.index") }}">
                        <i class="icon fas fa-user-times fa-5x" ></i>
                        <div class="lab"> <span> Suspensão de aulas </span> </div>
                        </a>
                        </div>
                      </div>
                      </div>

@endcan

@can('documento_access')

                <div class="card-icons">
                  <div class="card-body">
                    <div class="card-icon">
                    <a href="{{ route("admin.documentos.index") }}">
                    <i class="icon fas fa-folder-open fa-5x" ></i>
                    <div class="lab"> <span> Documentos </span> </div>
                    </a>
                    </div>
                  </div>
                  </div>
@endcan

              </div>
              </div>
@endcan

              <!-- Diário de Classe -->

@can('diario_de_classe_access')

            <div class="container-size">
            <div class="card"> <div class="card-header"> Diário de Classe </div> </div>
            <div class="cards-icons">

@can('presenca_eletiva_access')

              <div class="card-icons">
                <div class="card-body">
                  <div class="card-icon">
                  <a href="{{ route("admin.presenca-eletivas.index") }}">
                  <i class="icon fas fa-check-double fa-5x" ></i>
                  <div class="lab"> <span> Presença Eletiva </span> </div>
                  </a>
                  </div>
                </div>
                </div>

@endcan

@can('notum_access')

                  <div class="card-icons">
                    <div class="card-body">
                      <div class="card-icon">
                      <a href="{{ route("admin.nota.index") }}">
                       <i class="icon fas fa-address-book fa-5x"></i>
                      <div class="lab"> <span> Notas </span> </div>
                      </a>
                      </div>
                    </div>
                    </div>

@endcan

@can('desempenho_access')

                    <div class="card-icons">
                      <div class="card-body">
                        <div class="card-icon">
                        <a href="{{ route("admin.desempenhos.index") }}">
                        <i class="icon fas fa-chart-line fa-5x" ></i>
                        <div class="lab"> <span> Desempenho </span> </div>
                        </a>
                        </div>
                      </div>
                      </div>

@endcan

@can('conteudos_curriculare_access')

                      <div class="card-icons">
                        <div class="card-body">
                          <div class="card-icon">
                          <a href="{{ route("admin.conteudos-curriculares.index") }}">
                          <i class="icon far fa-paper-plane fa-5x"></i>
                          <div class="lab"> <span> Conteudos Curriculares </span> </div>
                          </a>
                          </div>
                        </div>
                        </div>

@endcan

@can('bncc_access')

                        <div class="card-icons">
                          <div class="card-body">
                            <div class="card-icon">
                            <a href="{{ route("admin.bnccs.index") }}">
                            <i class="icon fas fa-award fa-5x"></i>
                            <div class="lab"> <span> BNCC </span> </div>
                            </a>
                            </div>
                          </div>
                          </div>

@endcan

@can('curriculo_de_pernambuco_access')

                          <div class="card-icons">
                            <div class="card-body">
                              <div class="card-icon">
                              <a href="{{ route("admin.curriculo-de-pernambucos.index") }}">
                               <i class="icon fas fa-trophy fa-5x"></i>
                              <div class="lab"> <span> Currículo de Pernambuco </span> </div>
                              </a>
                              </div>
                            </div>
                            </div>

@endcan

@can('planejamento_bimestral_access')

                        <div class="card-icons">
                          <div class="card-body">
                            <div class="card-icon">
                            <a href="{{ route("admin.planejamento-bimestrals.index") }}">
                            <i class="icon fas fa-globe-americas fa-5x"></i>
                            <div class="lab"> <span> Planejamento Bimestral </span> </div>
                            </a>
                            </div>
                          </div>
                          </div>

@endcan

@can('propostas_de_aula_access')

                            <div class="card-icons">
                              <div class="card-body">
                                <div class="card-icon">
                                <a href="{{ route("admin.aulas.propostas") }}">
                                 <i class="icon fas fa-pen-square fa-5x"></i>
                                <div class="lab"> <span> Propostas de Aulas </span> </div>
                                </a>
                                </div>
                              </div>
                              </div>

@endcan

@can('banco_de_aula_access')

                              <div class="card-icons">
                                <div class="card-body">
                                  <div class="card-icon">
                                  <a href="{{ route("admin.banco-de-aulas.index") }}">
                                   <i class="icon fas fa-archive fa-5x"></i>
                                  <div class="lab"> <span> Banco De Aulas </span> </div>
                                  </a>
                                  </div>
                                </div>
                                </div>

@endcan

                  </div>
                  </div>

@endcan

                  <!-- Transporte Escolar   -->

@can('transporte_escolar_access')

                <div class="container-size">
                <div class="card"> <div class="card-header"> Transporte Escolar </div> </div>

@can('cadastrarveiculo_access')

                <div class="cards-icons">
                  <div class="card-icons">
                    <div class="card-body">
                      <div class="card-icon">
                      <a href="{{ route("admin.cadastrarveiculos.index") }}">
                      <i class="icon fas fa-bus fa-5x" ></i>
                      <div class="lab"> <span> Veículos </span> </div>
                      </a>
                      </div>
                    </div>
                    </div>

@endcan

@can('cadastrar_motoristum_access')

                      <div class="card-icons">
                        <div class="card-body">
                          <div class="card-icon">
                          <a href="{{ route("admin.cadastrar-motorista.index") }}">
                          <i class="icon fas fa-user-tie fa-5x" ></i>
                          <div class="lab"> <span> Motoristas </span> </div>
                          </a>
                          </div>
                        </div>
                        </div>

@endcan

@can('rotum_access')

                        <div class="card-icons">
                          <div class="card-body">
                            <div class="card-icon">
                            <a href="{{ route("admin.rota.index") }}">
                            <i class="icon fas fa-map fa-5x" ></i>
                            <div class="lab"> <span> Rotas </span> </div>
                            </a>
                            </div>
                          </div>
                          </div>

@endcan

                      </div>
                      </div>

@endcan

                      <!-- Bibliotecas -->

@can('biblioteca_access')

                    <div class="container-size">
                    <div class="card"> <div class="card-header"> Biblioteca </div> </div>

@can('cadastrar_biblioteca_access')

                    <div class="cards-icons">
                      <div class="card-icons">
                        <div class="card-body">
                          <div class="card-icon">
                          <a href="{{ route("admin.cadastrar-bibliotecas.index") }}">
                          <i class="icon fas fa-hotel fa-5x" ></i>
                          <div class="lab"> <span> Unidades </span> </div>
                          </a>
                          </div>
                        </div>
                        </div>

@endcan

@can('cadastrar_livro_access')

                          <div class="card-icons">
                            <div class="card-body">
                              <div class="card-icon">
                              <a href="{{ route("admin.cadastrar-livros.index") }}">
                              <i class="icon fas fa-book-open fa-5x" ></i>
                              <div class="lab"> <span> Livros </span> </div>
                              </a>
                              </div>
                            </div>
                            </div>

@endcan

@can('usuarios_da_biblioteca_access')

                            <div class="card-icons">
                              <div class="card-body">
                                <div class="card-icon">
                                <a href="{{ route("admin.usuarios-da-bibliotecas.index") }}">
                                <i class="icon fas fa-user-tag fa-5x"></i>
                                <div class="lab"> <span> Usuários Da Biblioteca </span> </div>
                                </a>
                                </div>
                              </div>
                              </div>

@endcan

@can('emprestimos_e_devoluco_access')

                              <div class="card-icons">
                                <div class="card-body">
                                  <div class="card-icon">
                                  <a href="{{ route("admin.emprestimos-e-devolucos.index") }}">
                                  <i class="icon fas fa-handshake fa-5x"></i>
                                  <div class="lab"> <span> Empréstimos e Devoluções </span> </div>
                                  </a>
                                  </div>
                                </div>
                                </div>

@endcan

@can('relatorios_da_biblioteca_access')

                                <div class="card-icons">
                                  <div class="card-body">
                                    <div class="card-icon">
                                    <a href="{{ route("admin.relatorios-da-bibliotecas.index") }}">
                                    <i class="icon fas fa-folder-open fa-5x"></i>
                                    <div class="lab"> <span> Relatórios Da Biblioteca </span> </div>
                                    </a>
                                    </div>
                                  </div>
                                  </div>

@endcan

                          </div>
                          </div>
@endcan
                          <!-- Almoxarifado -->

@can('cadastros_do_almoxarifado_access')

                        <div class="container-size">
                        <div class="card"> <div class="card-header"> Almoxarifado </div> </div>

@can('fornecedore_access')

                        <div class="cards-icons">
                          <div class="card-icons">
                            <div class="card-body">
                              <div class="card-icon">
                              <a href="{{ route("admin.fornecedores.index") }}">
                              <i class="icon fas fa-people-carry-box fa-5x"></i>
                              <div class="lab"> <span> Fornecedores </span> </div>
                              </a>
                              </div>
                            </div>
                            </div>

@endcan

@can('requisitante_access')

                              <div class="card-icons">
                                <div class="card-body">
                                  <div class="card-icon">
                                  <a href="{{ route("admin.requisitantes.index") }}">
                                  <i class="icon fas fa-person-booth fa-5x"></i>
                                  <div class="lab"> <span> Requisitanes </span> </div>
                                  </a>
                                  </div>
                                </div>
                                </div>

@endcan

@can('estoque_access')

                                <div class="card-icons">
                                  <div class="card-body">
                                    <div class="card-icon">
                                    <a href="{{ route("admin.estoques.index") }}">
                                    <i class="icon fas fa-dolly fa-5x"></i>
                                    <div class="lab"> <span> Estoques </span> </div>
                                    </a>
                                    </div>
                                  </div>
                                  </div>

@endcan

@can('categorias_de_produto_access')

                                  <div class="card-icons">
                                    <div class="card-body">
                                      <div class="card-icon">
                                      <a href="{{ route("admin.categorias-de-produtos.index") }}">
                                      <i class="icon fas fa-boxes-stacked fa-5x"></i>
                                      <div class="lab"> <span> Categorias De Produtos </span> </div>
                                      </a>
                                      </div>
                                    </div>
                                    </div>

@endcan

@can('produto_access')

                                    <div class="card-icons">
                                      <div class="card-body">
                                        <div class="card-icon">
                                        <a href="{{ route("admin.produtos.index") }}">
                                        <i class=" icon fas fa-parachute-box fa-5x"></i>
                                        <div class="lab"> <span> Produtos </span> </div>
                                        </a>
                                        </div>
                                      </div>
                                      </div>

@endcan

@can('entrada_no_estoque_access')

                                      <div class="card-icons">
                                        <div class="card-body">
                                          <div class="card-icon">
                                          <a href="{{ route("admin.entrada-no-estoques.index") }}">
                                          <i class="icon fas fa-door-closed fa-5x"></i>
                                          <div class="lab"> <span> Entrada no Estoque </span> </div>
                                          </a>
                                          </div>
                                        </div>
                                        </div>

@endcan

@can('saida_no_estoque_access')

                                        <div class="card-icons">
                                          <div class="card-body">
                                            <div class="card-icon">
                                            <a href="{{ route("admin.saida-no-estoques.index") }}">
                                            <i class="icon fas fa-door-open fa-5x"></i>
                                            <div class="lab"> <span> Saída No Estoque </span> </div>
                                            </a>
                                            </div>
                                          </div>
                                          </div>

@endcan

@can('requisico_access')

                                          <div class="card-icons">
                                            <div class="card-body">
                                              <div class="card-icon">
                                              <a href="{{ route("admin.requisicos.index") }}">
                                              <i class="icon fas fa-user-plus fa-5x"></i>
                                              <div class="lab"> <span> Requisições </span> </div>
                                              </a>
                                              </div>
                                            </div>
                                            </div>

@endcan

@can('pedidos_de_compra_access')


                                            <div class="card-icons">
                                              <div class="card-body">
                                                <div class="card-icon">
                                                <a href="{{ route("admin.pedidos-de-compras.index") }}">
                                                <i class="icon fas fa-cart-shopping fa-5x"></i>
                                                <div class="lab"> <span> Pedidos De Compra </span> </div>
                                                </a>
                                                </div>
                                              </div>
                                              </div>

@endcan

@can('relatorios_do_almoxarifado_access')

                                              <div class="card-icons">
                                                <div class="card-body">
                                                  <div class="card-icon">
                                                  <a href="{{ route("admin.relatorios-do-almoxarifados.index") }}">
                                                  <i class="icon fas fa-warehouse fa-5x"></i>
                                                  <div class="lab"> <span> Relatórios Do Almoxarifado </span> </div>
                                                  </a>
                                                  </div>
                                                </div>
                                                </div>

@endcan

                              </div>
                              </div>

@endcan

                              <!-- Gerenciar Calendario -->
@can('task_management_access')

                            <div class="container-size">
                            <div class="card"> <div class="card-header"> Gerenciar Calendario </div> </div>
                            <div class="cards-icons">

@can('tasks_calendar_access')

                            <div class="card-icons">
                            <div class="card-body">
                              <div class="card-icon">
                              <a href="{{ route("admin.tasks-calendars.index") }}">
                              <i class="icon fas fa-calendar-alt fa-5x" ></i>
                              <div class="lab"> <span> Calendário </span> </div>
                              </a>
                              </div>
                            </div>
                            </div>

@endcan

@can('task_status_access')

                            <div class="card-icons">
                              <div class="card-body">
                                <div class="card-icon">
                                <a href="{{ route("admin.task-statuses.index") }}">
                                <i class="icon fas fa-spinner fa-5x"> </i>
                                <div class="lab"> <span> Progressos </span> </div>
                                </a>
                                </div>
                              </div>
                              </div>

@endcan

@can('task_tag_access')

                            <div class="card-icons">
                              <div class="card-body">
                                <div class="card-icon">
                                <a href="{{ route("admin.task-tags.index") }}">
                                <i class="icon fas fa-stamp fa-5x"> </i>
                                <div class="lab"> <span> Categorias </span> </div>
                                </a>
                                </div>
                              </div>
                              </div>

@endcan

@can('task_access')

                              <div class="card-icons">
                                <div class="card-body">
                                  <div class="card-icon">
                                  <a href="{{ route("admin.tasks.index") }}">
                                  <i class="icon fas fa-star fa-5x"> </i>
                                  <div class="lab"> <span> Eventos </span> </div>
                                  </a>
                                  </div>
                                </div>
                                </div>

@endcan

                                </div>
                                </div>

@endcan


    </div>



  <link rel="stylesheet" href="{{ url('reports/icons.css') }}">
  <link rel="stylesheet" href="{{ url('reports/response.css') }}">
  <link rel="stylesheet" href="{{ url('css/panel.css') }}">
  <link rel="stylesheet" href="{{ url('css/home.css') }}">


@endsection
@section('scripts')
@parent

@endsection
