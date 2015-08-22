<?php

// rutas para logueo y cerrar sesión
Route::group(['middleware' => 'guest'], function () {
    get('/', ['as' => 'showLogin', 'uses' => 'Auth\AuthController@showLogin']);
    post('/login', ['as' => 'showLoginPost', 'uses' => 'Auth\AuthController@showLoginPost']);
});

get('/cerrar', ['as' => 'logoutSession', 'uses' => 'Auth\AuthController@getLogout']);
Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'admin'], function () {
        get('/inicio', ['as' => 'homeAdmin', function () {return view('admin.home');}]);
    });

    Route::group(['prefix' => 'user'], function () {
        get('/inicio', ['as' => 'homeUser', function () {return view('user.home');}]);
    });
});
