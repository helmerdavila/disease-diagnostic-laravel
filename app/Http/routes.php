<?php

//miaplicacio.com
get('/', function () {
    return view('login');
});
get('auth/login', 'Auth\AuthController@getLogin');
post('auth/login', 'Auth\AuthController@postLogin');
get('auth/logout', 'Auth\AuthController@getLogout');
