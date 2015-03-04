<?php

return [
    [
        'httpMethod' => 'GET',
        'route'      => '/',
        'service'    => 'index.controller',
        'method'     => 'index'
    ], [
        'httpMethod' => 'GET',
        'route'      => '/login',
        'service'    => 'login.controller',
        'method'     => 'getLogin'
    ], [
        'httpMethod' => 'GET',
        'route'      => '/setToken',
        'service'    => 'login.controller',
        'method'     => 'setLoginToken'
    ], [
        'httpMethod' => 'GET',
        'route'      => '/logout',
        'service'    => 'login.controller',
        'method'     => 'getLogout'
    ],
];
