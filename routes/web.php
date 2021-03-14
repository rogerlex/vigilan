<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Categoria
    Route::delete('categoria/destroy', 'CategoriasController@massDestroy')->name('categoria.massDestroy');
    Route::post('categoria/media', 'CategoriasController@storeMedia')->name('categoria.storeMedia');
    Route::post('categoria/ckmedia', 'CategoriasController@storeCKEditorImages')->name('categoria.storeCKEditorImages');
    Route::resource('categoria', 'CategoriasController', ['except' => ['show']]);

    // Tags
    Route::delete('tags/destroy', 'TagsController@massDestroy')->name('tags.massDestroy');
    Route::resource('tags', 'TagsController', ['except' => ['show']]);

    // Bairros
    Route::delete('bairros/destroy', 'BairrosController@massDestroy')->name('bairros.massDestroy');
    Route::resource('bairros', 'BairrosController');

    // Tipoestabelecimentos
    Route::delete('tipoestabelecimentos/destroy', 'TipoestabelecimentosController@massDestroy')->name('tipoestabelecimentos.massDestroy');
    Route::resource('tipoestabelecimentos', 'TipoestabelecimentosController');

    // Tipos Processos
    Route::delete('tipos-processos/destroy', 'TiposProcessosController@massDestroy')->name('tipos-processos.massDestroy');
    Route::resource('tipos-processos', 'TiposProcessosController');

    // Reg Denuncia
    Route::delete('reg-denuncia/destroy', 'RegDenunciasController@massDestroy')->name('reg-denuncia.massDestroy');
    Route::post('reg-denuncia/media', 'RegDenunciasController@storeMedia')->name('reg-denuncia.storeMedia');
    Route::post('reg-denuncia/ckmedia', 'RegDenunciasController@storeCKEditorImages')->name('reg-denuncia.storeCKEditorImages');
    Route::resource('reg-denuncia', 'RegDenunciasController');

    // Statuses
    Route::delete('statuses/destroy', 'StatusController@massDestroy')->name('statuses.massDestroy');
    Route::resource('statuses', 'StatusController');

    // Origens
    Route::delete('origens/destroy', 'OrigensController@massDestroy')->name('origens.massDestroy');
    Route::resource('origens', 'OrigensController', ['except' => ['show']]);

    // Processos
    Route::delete('processos/destroy', 'ProcessosController@massDestroy')->name('processos.massDestroy');
    Route::post('processos/media', 'ProcessosController@storeMedia')->name('processos.storeMedia');
    Route::post('processos/ckmedia', 'ProcessosController@storeCKEditorImages')->name('processos.storeCKEditorImages');
    Route::resource('processos', 'ProcessosController');

    // Estabelecimentos
    Route::delete('estabelecimentos/destroy', 'EstabelecimentosController@massDestroy')->name('estabelecimentos.massDestroy');
    Route::resource('estabelecimentos', 'EstabelecimentosController');

    // Formacaos
    Route::delete('formacaos/destroy', 'FormacaoController@massDestroy')->name('formacaos.massDestroy');
    Route::resource('formacaos', 'FormacaoController');

    // Cargos
    Route::delete('cargos/destroy', 'CargosController@massDestroy')->name('cargos.massDestroy');
    Route::resource('cargos', 'CargosController');

    // Colaboradores
    Route::delete('colaboradores/destroy', 'ColaboradoresController@massDestroy')->name('colaboradores.massDestroy');
    Route::resource('colaboradores', 'ColaboradoresController');

    // Identidadegeneros
    Route::delete('identidadegeneros/destroy', 'IdentidadegeneroController@massDestroy')->name('identidadegeneros.massDestroy');
    Route::resource('identidadegeneros', 'IdentidadegeneroController');

    // Departamentos
    Route::delete('departamentos/destroy', 'DepartamentosController@massDestroy')->name('departamentos.massDestroy');
    Route::resource('departamentos', 'DepartamentosController');

    // Atividades
    Route::delete('atividades/destroy', 'AtividadesController@massDestroy')->name('atividades.massDestroy');
    Route::post('atividades/media', 'AtividadesController@storeMedia')->name('atividades.storeMedia');
    Route::post('atividades/ckmedia', 'AtividadesController@storeCKEditorImages')->name('atividades.storeCKEditorImages');
    Route::resource('atividades', 'AtividadesController');

    // Visita
    Route::delete('visita/destroy', 'VisitasController@massDestroy')->name('visita.massDestroy');
    Route::post('visita/media', 'VisitasController@storeMedia')->name('visita.storeMedia');
    Route::post('visita/ckmedia', 'VisitasController@storeCKEditorImages')->name('visita.storeCKEditorImages');
    Route::resource('visita', 'VisitasController');

    // Pendencia
    Route::delete('pendencia/destroy', 'PendenciasController@massDestroy')->name('pendencia.massDestroy');
    Route::post('pendencia/media', 'PendenciasController@storeMedia')->name('pendencia.storeMedia');
    Route::post('pendencia/ckmedia', 'PendenciasController@storeCKEditorImages')->name('pendencia.storeCKEditorImages');
    Route::resource('pendencia', 'PendenciasController');

    // Baixaduams
    Route::delete('baixaduams/destroy', 'BaixaduamsController@massDestroy')->name('baixaduams.massDestroy');
    Route::post('baixaduams/media', 'BaixaduamsController@storeMedia')->name('baixaduams.storeMedia');
    Route::post('baixaduams/ckmedia', 'BaixaduamsController@storeCKEditorImages')->name('baixaduams.storeCKEditorImages');
    Route::resource('baixaduams', 'BaixaduamsController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
