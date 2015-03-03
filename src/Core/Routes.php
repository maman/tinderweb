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
        'httpMethod' => 'POST',
        'route'      => '/login',
        'service'    => 'login.controller',
        'method'     => 'postLogin'
    ], [
        'httpMethod' => 'GET',
        'route'      => '/logout',
        'service'    => 'login.controller',
        'method'     => 'getLogout'
    ],
];
