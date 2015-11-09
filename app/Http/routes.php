<?php

// rutas para logueo y cerrar sesión
get('/', ['as' => 'showLogin', 'uses' => 'Auth\AuthController@showLogin']);
post('/login', ['as' => 'showLoginPost', 'uses' => 'Auth\AuthController@showLoginPost']);
get('/registrar', ['as' => 'showRegister', 'uses' => 'Auth\AuthController@showRegister']);
post('/registrar', ['as' => 'showRegisterPost', 'uses' => 'Auth\AuthController@showRegisterPost']);
get('/cerrar', ['as' => 'logoutSession', 'uses' => 'Auth\AuthController@getLogout']);

Route::group(['middleware' => 'auth'], function () {

    // mini api
    Route::group(['prefix' => 'api', 'as' => 'api::'], function () {
        get('/all-diseases', 'Admin\ReportController@all_diseases');
        get('/two-top', 'Admin\ReportController@top_two_diagnostic');
        get('/diagnostics-by-state', 'Admin\ReportController@diagnostics_by_state');
        get('/users-by-state', 'Admin\ReportController@users_by_state');
        get('/top-users-diagnostics', 'Admin\ReportController@top_users_diagnostics');
        get('/top-diseases-diagnostics', 'Admin\ReportController@top_diseases_diagnostics');
        get('/anual-disease-diagnostics/{disease_id}', 'Admin\ReportController@anual_disease_diagnostics');
        get('/anual-state-diagnostics/{state_id}', 'Admin\ReportController@anual_state_diagnostics');
        get('/user-diseases', 'User\ReportController@user_diseases');
    });

    /**
     * Rutas para el Administrador
     */
    Route::group(['prefix' => 'admin', 'as' => 'admin::'], function () {
        get('/inicio', ['as' => 'home', 'uses' => 'Admin\HomeController@home']);
        get('/perfil', ['as' => 'perfil', 'uses' => 'Admin\HomeController@profile']);
        post('/actualizar-perfil', ['as' => 'perfil::actualizar', 'uses' => 'Admin\HomeController@profile_update']);
        post('/actualizar-password', ['as' => 'password::actualizar', 'uses' => 'Admin\HomeController@password_update']);

        // sintomas
        Route::group(['prefix' => 'sintomas', 'as' => 'sintomas::'], function () {
            get('/listar', ['as' => 'create', 'uses' => 'Admin\SymptomController@create']);
            post('/listar', ['as' => 'store', 'uses' => 'Admin\SymptomController@store']);
            get('/buscar', ['as' => 'buscar', 'uses' => 'Admin\SymptomController@search']);
            get('/editar/{id}', ['as' => 'edit', 'uses' => 'Admin\SymptomController@edit']);
            post('/editar/{id}', ['as' => 'update', 'uses' => 'Admin\SymptomController@update']);
            post('/eliminar/{id}', ['as' => 'delete', 'uses' => 'Admin\SymptomController@delete']);
        });

        // enfermedades
        Route::group(['prefix' => 'enfermedades', 'as' => 'enfermedades::'], function () {
            get('/listar', ['as' => 'create', 'uses' => 'Admin\DiseaseController@create']);
            post('/listar', ['as' => 'store', 'uses' => 'Admin\DiseaseController@store']);
            get('/buscar', ['as' => 'buscar', 'uses' => 'Admin\DiseaseController@search']);
            get('/editar/{id}', ['as' => 'edit', 'uses' => 'Admin\DiseaseController@edit']);
            post('/editar/{id}', ['as' => 'update', 'uses' => 'Admin\DiseaseController@update']);
            post('/eliminar/{id}', ['as' => 'delete', 'uses' => 'Admin\DiseaseController@delete']);
        });

        // diagnosticos
        Route::group(['prefix' => 'diagnosticos', 'as' => 'diagnosticos::'], function () {
            get('/listar', ['as' => 'index', 'uses' => 'Admin\DiagnosticController@index']);
        });

        // usuarios
        Route::group(['prefix' => 'usuarios', 'as' => 'usuarios::'], function () {
            get('/listar', ['as' => 'create', 'uses' => 'Admin\UserController@create']);
            post('/listar', ['as' => 'store', 'uses' => 'Admin\UserController@store']);
            get('/editar/{id}', ['as' => 'edit', 'uses' => 'Admin\UserController@edit']);
            post('/editar/{id}', ['as' => 'update', 'uses' => 'Admin\UserController@update']);
            post('/eliminar/{id}', ['as' => 'delete', 'uses' => 'Admin\UserController@delete']);
        });

        // Reportes
        Route::group(['prefix' => 'reportes', 'as' => 'reportes::'], function () {
            get('/listar', ['as' => 'index', 'uses' => 'Admin\ReportController@index']);
        });
    });

    /**
     * Rutas para el usuario
     */
    Route::group(['prefix' => 'user', 'as' => 'user::'], function () {
        get('/inicio', ['as' => 'home', 'uses' => 'User\HomeController@index']);
        get('/perfil', ['as' => 'perfil', 'uses' => 'User\HomeController@profile']);
        post('/actualizar-perfil', ['as' => 'perfil::actualizar', 'uses' => 'User\HomeController@profile_update']);
        post('/actualizar-password', ['as' => 'password::actualizar', 'uses' => 'User\HomeController@password_update']);

        Route::group(['prefix' => 'diagnosticos', 'as' => 'diagnosticos::'], function () {
            get('/nuevo', ['as' => 'create', 'uses' => 'User\DiagnosticController@create']);
            post('/nuevo', ['as' => 'analyze', 'uses' => 'User\DiagnosticController@analyze']);
            get('/listar', ['as' => 'index', 'uses' => 'User\DiagnosticController@index']);
            get('/mostrar/{id?}', ['as' => 'show', 'uses' => 'User\DiagnosticController@show']);
        });

        Route::group(['prefix' => 'sintomas', 'as' => 'sintomas::'], function () {
            get('/listar', ['as' => 'index', 'uses' => 'User\SymptomController@index']);
        });

        Route::group(['prefix' => 'enfermedades', 'as' => 'enfermedades::'], function () {
            get('/listar', ['as' => 'index', 'uses' => 'User\DiseaseController@index']);
        });
    });
});
