<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

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

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Bairros
    Route::delete('bairros/destroy', 'BairroController@massDestroy')->name('bairros.massDestroy');
    Route::resource('bairros', 'BairroController');

    // Denunciacategoria
    Route::delete('denunciacategoria/destroy', 'DenunciacategoriaController@massDestroy')->name('denunciacategoria.massDestroy');
    Route::resource('denunciacategoria', 'DenunciacategoriaController');

    // Tags Denuncia
    Route::delete('tags-denuncia/destroy', 'TagsDenunciasController@massDestroy')->name('tags-denuncia.massDestroy');
    Route::resource('tags-denuncia', 'TagsDenunciasController');

    // Denuncia
    Route::delete('denuncia/destroy', 'DenunciasController@massDestroy')->name('denuncia.massDestroy');
    Route::post('denuncia/media', 'DenunciasController@storeMedia')->name('denuncia.storeMedia');
    Route::post('denuncia/ckmedia', 'DenunciasController@storeCKEditorImages')->name('denuncia.storeCKEditorImages');
    Route::resource('denuncia', 'DenunciasController');

    // Estabelecimentos
    Route::delete('estabelecimentos/destroy', 'EstabelecimentoController@massDestroy')->name('estabelecimentos.massDestroy');
    Route::resource('estabelecimentos', 'EstabelecimentoController');

    // Tipo Processos
    Route::delete('tipo-processos/destroy', 'TipoProcessoController@massDestroy')->name('tipo-processos.massDestroy');
    Route::resource('tipo-processos', 'TipoProcessoController');

    // Tagprocessos
    Route::delete('tagprocessos/destroy', 'TagprocessoController@massDestroy')->name('tagprocessos.massDestroy');
    Route::resource('tagprocessos', 'TagprocessoController');

    // Tipo Estabelecimentos
    Route::delete('tipo-estabelecimentos/destroy', 'TipoEstabelecimentoController@massDestroy')->name('tipo-estabelecimentos.massDestroy');
    Route::resource('tipo-estabelecimentos', 'TipoEstabelecimentoController');

    // Processos
    Route::delete('processos/destroy', 'ProcessosController@massDestroy')->name('processos.massDestroy');
    Route::post('processos/media', 'ProcessosController@storeMedia')->name('processos.storeMedia');
    Route::post('processos/ckmedia', 'ProcessosController@storeCKEditorImages')->name('processos.storeCKEditorImages');
    Route::resource('processos', 'ProcessosController');

    // Task Statuses
    Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tags
    Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
    Route::resource('task-tags', 'TaskTagController');

    // Tasks
    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
    Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
    Route::resource('tasks', 'TaskController');

    // Tasks Calendars
    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

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
