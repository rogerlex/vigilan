<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Bairros
    Route::apiResource('bairros', 'BairroApiController');

    // Denunciacategoria
    Route::apiResource('denunciacategoria', 'DenunciacategoriaApiController');

    // Tags Denuncia
    Route::apiResource('tags-denuncia', 'TagsDenunciasApiController');

    // Denuncia
    Route::post('denuncia/media', 'DenunciasApiController@storeMedia')->name('denuncia.storeMedia');
    Route::apiResource('denuncia', 'DenunciasApiController');

    // Estabelecimentos
    Route::apiResource('estabelecimentos', 'EstabelecimentoApiController');

    // Tipo Processos
    Route::apiResource('tipo-processos', 'TipoProcessoApiController');

    // Tagprocessos
    Route::apiResource('tagprocessos', 'TagprocessoApiController');

    // Tipo Estabelecimentos
    Route::apiResource('tipo-estabelecimentos', 'TipoEstabelecimentoApiController');

    // Processos
    Route::post('processos/media', 'ProcessosApiController@storeMedia')->name('processos.storeMedia');
    Route::apiResource('processos', 'ProcessosApiController');

    // Task Statuses
    Route::apiResource('task-statuses', 'TaskStatusApiController');

    // Task Tags
    Route::apiResource('task-tags', 'TaskTagApiController');

    // Tasks
    Route::post('tasks/media', 'TaskApiController@storeMedia')->name('tasks.storeMedia');
    Route::apiResource('tasks', 'TaskApiController');
});
