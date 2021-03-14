<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Categoria
    Route::post('categoria/media', 'CategoriasApiController@storeMedia')->name('categoria.storeMedia');
    Route::apiResource('categoria', 'CategoriasApiController', ['except' => ['show']]);

    // Tags
    Route::apiResource('tags', 'TagsApiController', ['except' => ['show']]);

    // Bairros
    Route::apiResource('bairros', 'BairrosApiController');

    // Tipoestabelecimentos
    Route::apiResource('tipoestabelecimentos', 'TipoestabelecimentosApiController');

    // Tipos Processos
    Route::apiResource('tipos-processos', 'TiposProcessosApiController');

    // Reg Denuncia
    Route::post('reg-denuncia/media', 'RegDenunciasApiController@storeMedia')->name('reg-denuncia.storeMedia');
    Route::apiResource('reg-denuncia', 'RegDenunciasApiController');

    // Statuses
    Route::apiResource('statuses', 'StatusApiController');

    // Origens
    Route::apiResource('origens', 'OrigensApiController', ['except' => ['show']]);

    // Processos
    Route::post('processos/media', 'ProcessosApiController@storeMedia')->name('processos.storeMedia');
    Route::apiResource('processos', 'ProcessosApiController');

    // Estabelecimentos
    Route::apiResource('estabelecimentos', 'EstabelecimentosApiController');

    // Formacaos
    Route::apiResource('formacaos', 'FormacaoApiController');

    // Cargos
    Route::apiResource('cargos', 'CargosApiController');

    // Colaboradores
    Route::apiResource('colaboradores', 'ColaboradoresApiController');

    // Identidadegeneros
    Route::apiResource('identidadegeneros', 'IdentidadegeneroApiController');

    // Departamentos
    Route::apiResource('departamentos', 'DepartamentosApiController');

    // Atividades
    Route::post('atividades/media', 'AtividadesApiController@storeMedia')->name('atividades.storeMedia');
    Route::apiResource('atividades', 'AtividadesApiController');

    // Visita
    Route::post('visita/media', 'VisitasApiController@storeMedia')->name('visita.storeMedia');
    Route::apiResource('visita', 'VisitasApiController');

    // Pendencia
    Route::post('pendencia/media', 'PendenciasApiController@storeMedia')->name('pendencia.storeMedia');
    Route::apiResource('pendencia', 'PendenciasApiController');

    // Baixaduams
    Route::post('baixaduams/media', 'BaixaduamsApiController@storeMedia')->name('baixaduams.storeMedia');
    Route::apiResource('baixaduams', 'BaixaduamsApiController');
});
