<?php

// rutas para logueo y cerrar sesión
get('/', ['as' => 'showLogin', 'uses' => 'Auth\AuthController@showLogin']);
post('/login', ['as' => 'showLoginPost', 'uses' => 'Auth\AuthController@showLoginPost']);
get('/registrar', ['as' => 'showRegister', 'uses' => 'Auth\AuthController@showRegister']);
post('/registrar', ['as' => 'showRegisterPost', 'uses' => 'Auth\AuthController@showRegisterPost']);
get('/fblogin', ['as' => 'facebookLogin', 'uses' => 'Auth\AuthController@redirectToProvider']);
get('/fbloginpost', 'Auth\AuthController@handleProviderCallback');

get('/cerrar', ['as' => 'logoutSession', 'uses' => 'Auth\AuthController@getLogout']);
Route::group(['middleware' => 'auth'], function () {

    /**
     * Rutas para el Administrador
     */
    Route::group(['prefix' => 'admin', 'as' => 'admin::'], function () {
        get('/inicio', ['as' => 'home', 'uses' => 'Admin\HomeController@home']);

        // sintomas
        Route::group(['prefix' => 'sintomas', 'as' => 'sintomas::'], function () {
            get('/listar', ['as' => 'create', 'uses' => 'Admin\SymptomController@create']);
            post('/listar', ['as' => 'store', 'uses' => 'Admin\SymptomController@store']);
            get('/editar/{id}', ['as' => 'edit', 'uses' => 'Admin\SymptomController@edit']);
            post('/editar/{id}', ['as' => 'update', 'uses' => 'Admin\SymptomController@update']);
            post('/eliminar/{id}', ['as' => 'delete', 'uses' => 'Admin\SymptomController@delete']);
        });

        // enfermedades
        Route::group(['prefix' => 'enfermedades', 'as' => 'enfermedades::'], function () {
            get('/listar', ['as' => 'create', 'uses' => 'Admin\DiseaseController@create']);
            post('/listar', ['as' => 'store', 'uses' => 'Admin\DiseaseController@store']);
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
        });
    });

    /**
     * Rutas para el usuario
     */
    Route::group(['prefix' => 'user', 'as' => 'user::'], function () {
        get('/inicio', ['as' => 'home', 'uses' => 'User\HomeController@index']);

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
