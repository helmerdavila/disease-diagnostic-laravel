<?php

// Rutas para logueo y cerrar sesión
Route::get('/', ['as' => 'showLogin', 'uses' => 'Auth\AuthController@showLogin']);

Route::post('/login', ['as' => 'showLoginPost', 'uses' => 'Auth\AuthController@showLoginPost']);
Route::get('/register', ['as' => 'showRegister', 'uses' => 'Auth\AuthController@showRegister']);
Route::post('/register', ['as' => 'showRegisterPost', 'uses' => 'Auth\AuthController@showRegisterPost']);
Route::get('/logout', ['as' => 'logoutSession', 'uses' => 'Auth\AuthController@Route::getLogout']);

// Rutas para resetear contraseñas
Route::get('password/email', 'Auth\PasswordController@Route::getEmail');
Route::post('password/email', 'Auth\PasswordController@Route::postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@Route::getReset');
Route::post('password/reset', 'Auth\PasswordController@Route::postReset');

Route::group(['middleware' => 'auth'], function () {

    // mini api
    Route::group(['prefix' => 'api', 'as' => 'api::'], function () {
        Route::get('/all-diseases', 'Admin\ReportController@all_diseases');
        Route::get('/two-top', 'Admin\ReportController@top_two_diagnostic');
        Route::get('/diagnostics-by-state', 'Admin\ReportController@diagnostics_by_state');
        Route::get('/users-by-state', 'Admin\ReportController@users_by_state');
        Route::get('/top-users-diagnostics', 'Admin\ReportController@top_users_diagnostics');
        Route::get('/top-diseases-diagnostics', 'Admin\ReportController@top_diseases_diagnostics');
        Route::get('/anual-disease-diagnostics/{disease_id}', 'Admin\ReportController@anual_disease_diagnostics');
        Route::get('/anual-state-diagnostics/{state_id}', 'Admin\ReportController@anual_state_diagnostics');
        Route::get('/user-diseases', 'User\ReportController@user_diseases');
    });

    /**
     * Rutas para el Administrador
     */
    Route::group(['prefix' => 'admin', 'as' => 'admin::', 'middleware' => 'soloAdmin'], function () {
        Route::get('/inicio', ['as' => 'home', 'uses' => 'Admin\HomeController@home']);
        Route::get('/perfil', ['as' => 'perfil', 'uses' => 'Admin\HomeController@profile']);
        Route::post('/actualizar-perfil', ['as' => 'perfil::actualizar', 'uses' => 'Admin\HomeController@profile_update']);
        Route::post('/actualizar-password', ['as' => 'password::actualizar', 'uses' => 'Admin\HomeController@password_update']);

        // sintomas
        Route::group(['prefix' => 'sintomas', 'as' => 'sintomas::'], function () {
            Route::get('/listar', ['as' => 'create', 'uses' => 'Admin\SymptomController@create']);
            Route::post('/listar', ['as' => 'store', 'uses' => 'Admin\SymptomController@store']);
            Route::get('/buscar', ['as' => 'buscar', 'uses' => 'Admin\SymptomController@search']);
            Route::get('/editar/{id}', ['as' => 'edit', 'uses' => 'Admin\SymptomController@edit']);
            Route::post('/editar/{id}', ['as' => 'update', 'uses' => 'Admin\SymptomController@update']);
            Route::post('/eliminar/{id}', ['as' => 'delete', 'uses' => 'Admin\SymptomController@delete']);
        });

        // enfermedades
        Route::group(['prefix' => 'enfermedades', 'as' => 'enfermedades::'], function () {
            Route::get('/listar', ['as' => 'create', 'uses' => 'Admin\DiseaseController@create']);
            Route::post('/listar', ['as' => 'store', 'uses' => 'Admin\DiseaseController@store']);
            Route::get('/buscar', ['as' => 'buscar', 'uses' => 'Admin\DiseaseController@search']);
            Route::get('/editar/{id}', ['as' => 'edit', 'uses' => 'Admin\DiseaseController@edit']);
            Route::post('/editar/{id}', ['as' => 'update', 'uses' => 'Admin\DiseaseController@update']);
            Route::post('/eliminar/{id}', ['as' => 'delete', 'uses' => 'Admin\DiseaseController@delete']);
            Route::get('/agregar-regla/{id}', ['as' => 'regla', 'uses' => 'Admin\DiseaseController@add_rule']);
            Route::post('/agregar-regla/{id}', ['as' => 'regla', 'uses' => 'Admin\DiseaseController@add_rule']);
            Route::post('/eliminar-regla/{id}', ['as' => 'regla::delete', 'uses' => 'Admin\DiseaseController@delete_rule']);
        });

        // diagnosticos
        Route::group(['prefix' => 'diagnosticos', 'as' => 'diagnosticos::'], function () {
            Route::get('/listar', ['as' => 'index', 'uses' => 'Admin\DiagnosticController@index']);
            Route::get('/buscar', ['as' => 'buscar', 'uses' => 'Admin\DiagnosticController@search']);
        });

        // usuarios
        Route::group(['prefix' => 'usuarios', 'as' => 'usuarios::'], function () {
            Route::get('/listar', ['as' => 'create', 'uses' => 'Admin\UserController@create']);
            Route::post('/listar', ['as' => 'store', 'uses' => 'Admin\UserController@store']);
            Route::get('/buscar', ['as' => 'buscar', 'uses' => 'Admin\UserController@search']);
            Route::get('/editar/{id}', ['as' => 'edit', 'uses' => 'Admin\UserController@edit']);
            Route::post('/editar/{id}', ['as' => 'update', 'uses' => 'Admin\UserController@update']);
            Route::post('/eliminar/{id}', ['as' => 'delete', 'uses' => 'Admin\UserController@delete']);
        });

        Route::group(['prefix' => 'states', 'as' => 'states::'], function () {
            Route::get('/list', ['as' => 'create', 'uses' => 'Admin\StateController@create']);
            Route::post('/list', ['as' => 'store', 'uses' => 'Admin\StateController@store']);
            Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'Admin\StateController@edit']);
            Route::post('/edit/{id}', ['as' => 'update', 'uses' => 'Admin\StateController@update']);
            Route::post('/delete/{id}', ['as' => 'delete', 'uses' => 'Admin\StateController@delete']);
        });

        // Reportes
        Route::group(['prefix' => 'reportes', 'as' => 'reportes::'], function () {
            Route::get('/listar', ['as' => 'index', 'uses' => 'Admin\ReportController@index']);
        });
    });

    /**
     * Rutas para el usuario
     */
    Route::group(['prefix' => 'user', 'as' => 'user::', 'middleware' => 'soloPaciente'], function () {
        Route::get('/inicio', ['as' => 'home', 'uses' => 'User\HomeController@index']);
        Route::get('/perfil', ['as' => 'perfil', 'uses' => 'User\HomeController@profile']);
        Route::post('/actualizar-perfil', ['as' => 'perfil::actualizar', 'uses' => 'User\HomeController@profile_update']);
        Route::post('/actualizar-password', ['as' => 'password::actualizar', 'uses' => 'User\HomeController@password_update']);

        Route::group(['prefix' => 'diagnosticos', 'as' => 'diagnosticos::'], function () {
            Route::get('/nuevo', ['as' => 'create', 'uses' => 'User\DiagnosticController@create']);
            Route::post('/nuevo', 'User\DiagnosticController@create');
            Route::get('/analizar', 'User\DiagnosticController@analyze');
            Route::post('/analizar', ['as' => 'analyze', 'uses' => 'User\DiagnosticController@analyze']);
            Route::get('/listar', ['as' => 'index', 'uses' => 'User\DiagnosticController@index']);
            Route::get('/mostrar/{id?}', ['as' => 'show', 'uses' => 'User\DiagnosticController@show']);
            Route::get('/eliminar-sintoma/{id}', ['as' => 'delete::symptom', 'uses' => 'User\DiagnosticController@delete_symptom']);
        });

        Route::group(['prefix' => 'sintomas', 'as' => 'sintomas::'], function () {
            Route::get('/listar', ['as' => 'index', 'uses' => 'User\SymptomController@index']);
        });

        Route::group(['prefix' => 'enfermedades', 'as' => 'enfermedades::'], function () {
            Route::get('/listar', ['as' => 'index', 'uses' => 'User\DiseaseController@index']);
        });
    });
});
