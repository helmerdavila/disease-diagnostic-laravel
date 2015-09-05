<?php

// rutas para logueo y cerrar sesión
Route::group(['middleware' => 'guest'], function () {
    get('/', ['as' => 'showLogin', 'uses' => 'Auth\AuthController@showLogin']);
    post('/login', ['as' => 'showLoginPost', 'uses' => 'Auth\AuthController@showLoginPost']);
});

get('/cerrar', ['as' => 'logoutSession', 'uses' => 'Auth\AuthController@getLogout']);
Route::group(['middleware' => 'auth'], function () {

    /**
     * Rutas para el Administrador
     */
    Route::group(['prefix' => 'admin', 'as' => 'admin::'], function () {
        get('/inicio', ['as' => 'home', 'uses' => 'Admin\HomeController@home']);

        // sintomas
        Route::group(['prefix' => 'sintomas', 'as' => 'sintomas::'], function () {
            get('/listar', ['as' => 'index', 'uses' => 'Admin\SymptomController@index']);
            post('/listar', ['as' => 'create', 'uses' => 'Admin\SymptomController@create']);
        });

        // enfermedades
        Route::group(['prefix' => 'enfermedades', 'as' => 'enfermedades::'], function () {
            get('/listar', ['as' => 'index', 'uses' => 'Admin\DiseaseController@index']);
            post('/listar', ['as' => 'create', 'uses' => 'Admin\DiseaseController@create']);
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
        });
    });

    /**
     * Rutas para el usuario
     */
    Route::group(['prefix' => 'user', 'as' => 'user::'], function () {
        get('/inicio', ['as' => 'home', 'uses' => 'User\HomeController@index']);

        Route::group(['prefix' => 'diagnosticos', 'as' => 'diagnosticos::'], function () {
            get('/nuevo', ['as' => 'index', 'uses' => 'User\DiagnosticController@index']);
            post('/nuevo', ['as' => 'analyze', 'uses' => 'User\DiagnosticController@analyze']);
        });
    });
});
