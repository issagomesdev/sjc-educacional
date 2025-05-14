<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Task Status
    Route::apiResource('task-statuses', 'TaskStatusApiController');

    // Task Tag
    Route::apiResource('task-tags', 'TaskTagApiController');

    // Task
    Route::post('tasks/media', 'TaskApiController@storeMedia')->name('tasks.storeMedia');
    Route::apiResource('tasks', 'TaskApiController');

    // User Alerts
    Route::post('user-alerts/media', 'UserAlertsApiController@storeMedia')->name('user-alerts.storeMedia');
    Route::apiResource('user-alerts', 'UserAlertsApiController');

    // Team
    Route::apiResource('teams', 'TeamApiController');

    // Materias
    Route::apiResource('materia', 'MateriasApiController');

    // Turmas
    Route::apiResource('turmas', 'TurmasApiController');

    // Quadro De Horarios
    Route::apiResource('quadro-de-horarios', 'QuadroDeHorariosApiController');

    // Banco De Aulas
    Route::post('banco-de-aulas/media', 'BancoDeAulasApiController@storeMedia')->name('banco-de-aulas.storeMedia');
    Route::apiResource('banco-de-aulas', 'BancoDeAulasApiController');

    // Presenca Eletiva
    Route::apiResource('presenca-eletivas', 'PresencaEletivaApiController');

    // Direcao
    Route::post('direcaos/media', 'DirecaoApiController@storeMedia')->name('direcaos.storeMedia');
    Route::apiResource('direcaos', 'DirecaoApiController');

    // Secretaria
    Route::post('secretaria/media', 'SecretariaApiController@storeMedia')->name('secretaria.storeMedia');
    Route::apiResource('secretaria', 'SecretariaApiController');

    // Educadores
    Route::post('educadores/media', 'EducadoresApiController@storeMedia')->name('educadores.storeMedia');
    Route::apiResource('educadores', 'EducadoresApiController');

    // Vagas
    Route::apiResource('vagas', 'VagasApiController');

    // Cadastrar Biblioteca
    Route::apiResource('cadastrar-bibliotecas', 'CadastrarBibliotecaApiController');

    // Cadastrar Livro
    Route::apiResource('cadastrar-livros', 'CadastrarLivroApiController');

    // Cadastrar Motorista
    Route::post('cadastrar-motorista/media', 'CadastrarMotoristaApiController@storeMedia')->name('cadastrar-motorista.storeMedia');
    Route::apiResource('cadastrar-motorista', 'CadastrarMotoristaApiController');

    // Cadastrarveiculo
    Route::apiResource('cadastrarveiculos', 'CadastrarveiculoApiController');

    // Documentos
    Route::post('documentos/media', 'DocumentosApiController@storeMedia')->name('documentos.storeMedia');
    Route::apiResource('documentos', 'DocumentosApiController');

    // Rotas
    Route::post('rota/media', 'RotasApiController@storeMedia')->name('rota.storeMedia');
    Route::apiResource('rota', 'RotasApiController');

    // Banco De Projetos
    Route::post('banco-de-projetos/media', 'BancoDeProjetosApiController@storeMedia')->name('banco-de-projetos.storeMedia');
    Route::apiResource('banco-de-projetos', 'BancoDeProjetosApiController');

    // Propostas De Aulas
    Route::post('propostas-de-aulas/media', 'PropostasDeAulasApiController@storeMedia')->name('propostas-de-aulas.storeMedia');
    Route::apiResource('propostas-de-aulas', 'PropostasDeAulasApiController');

    // Dispensa
    Route::apiResource('dispensas', 'DispensaApiController');

    // Transferencias
    Route::apiResource('transferencia', 'TransferenciasApiController');

    // Conteudos Curriculares
    Route::apiResource('conteudos-curriculares', 'ConteudosCurricularesApiController');

    // Cadastro
    Route::post('cadastros/media', 'CadastroApiController@storeMedia')->name('cadastros.storeMedia');
    Route::apiResource('cadastros', 'CadastroApiController');

    // Planejamento Bimestral
    Route::post('planejamento-bimestrals/media', 'PlanejamentoBimestralApiController@storeMedia')->name('planejamento-bimestrals.storeMedia');
    Route::apiResource('planejamento-bimestrals', 'PlanejamentoBimestralApiController');

    // Semaulas
    Route::post('semaulas/media', 'SemaulasApiController@storeMedia')->name('semaulas.storeMedia');
    Route::apiResource('semaulas', 'SemaulasApiController');

    // Deslocar
    Route::apiResource('deslocars', 'DeslocarApiController');

    // Usuarios Especiais
    Route::post('usuarios-especiais/media', 'UsuariosEspeciaisApiController@storeMedia')->name('usuarios-especiais.storeMedia');
    Route::apiResource('usuarios-especiais', 'UsuariosEspeciaisApiController');

    // Propostas De Projetos
    Route::post('propostas-de-projetos/media', 'PropostasDeProjetosApiController@storeMedia')->name('propostas-de-projetos.storeMedia');
    Route::apiResource('propostas-de-projetos', 'PropostasDeProjetosApiController');

    // Matriculas
    Route::apiResource('matriculas', 'MatriculasApiController');

    // Instalar
    Route::apiResource('instalars', 'InstalarApiController');

    // Rematricula
    Route::apiResource('rematriculas', 'RematriculaApiController');

    // Notas
    Route::apiResource('nota', 'NotasApiController');

    // Type
    Route::apiResource('types', 'TypeApiController');
});
